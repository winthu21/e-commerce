<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Review;
use App\Models\Payment;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\PaySlipHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;


class ShopController extends Controller
{

    //ShopList
    public function shop($category_id = null){
        $products = Products::when(request('searchKey'),function($query){
                                    $query->where('products.name','like','%'.request('searchKey').'%');
                                    })
                            ->select('products.*','categories.name as category_name')
                            ->leftJoin('categories','products.category_id','categories.id');

        // data price နဲ့ရှာနည်း ၂နည်း

        // $products = $products->when(request('minPrice'),function($query){
        //                             $query->where('products.price','>=',request('minPrice'));
        //                             });

        // $products = $products->when(request('maxPrice'),function($query){
        //                             $query->where('products.price','<=',request('maxPrice'));
        //                             });

        if ( request('minPrice') != null && request('maxPrice') != null ){
            $products = $products->whereBetween('products.price',[request('minPrice'),request('maxPrice')]);
        }

        if ( request('minPrice') != null && request('maxPrice') == null ){
            $products = $products->where('products.price','>=',request('minPrice'));
        }

        if ( request('minPrice') == null && request('maxPrice') != null ){
            $products = $products->where('products.price','<=',request('maxPrice'));
        }
        //Paginate လုပ်ပြီးတဲ့အခါ old data error နည်းနည်းတက်

        if ($category_id == null){
            $products = $products->paginate(9);
        } else {
            $products = $products->where('products.category_id',$category_id)
                                ->orderBy('created_at','desc')
                                ->paginate(9);
        }
        $category = Category::get();

        $productsCount = Products::count();
        // dd($categoryCount);

        return view('user.shop',compact('products','category','productsCount'));
    }

    // Item Details
    public function details($id){
        // dd ($id);
        $product = Products::select('products.*','categories.id as category_id','categories.name as category_name')
                            ->leftJoin('categories','products.category_id','categories.id')
                            ->where('products.id',$id)
                            ->first();

        // comment detail
        $comment = Review::select('reviews.*','users.id as userID','users.name','users.nickname','users.profile')
                            ->leftJoin('users','reviews.user_id','users.id')
                            ->where('reviews.product_id',$id)
                            ->get();

        // rating count
        $ratingCount = Rating::where('product_id',$id)->avg('rating_count');

        $userRating = Rating::where('product_id',$id)
                            ->where('user_id',Auth::user()->id)
                            ->first();

        // $userRating = $userRating['rating_count'];
        $userRating = $userRating == null ? 0 : $userRating['rating_count'];

        // related Products
        $relatedProductCategory = Products::where('products.id',$id)
                                        ->first();
        $relatedProductCategory = $relatedProductCategory['category_id'];

        $relatedProducts = Products::select('products.*','categories.id as category_id','categories.name as category_name')
                                    ->leftJoin('categories','products.category_id','categories.id')
                                    ->where('products.category_id',$relatedProductCategory)
                                    ->get();
        return view('user.shop-detail',compact('product','comment','ratingCount','userRating','relatedProducts'));
    }

    // Comment
    public function comment(Request $request){

        $request->validate([
            'comment' => 'required'
        ]);
        $data = [
            'product_id' => $request->productID,
            'user_id' => $request->userID,
            'message' => $request->comment
        ];
        Review::create($data);

        Alert::success('Comment Success', 'Comment successfully created....');
        return back();
    }

    // Product Rating
    public function addRating(Request $request){
        $ratingCheckData = Rating::where('product_id',$request->productID)
                                ->where('user_id',$request->userID)
                                ->first();
        if ( $ratingCheckData == null ){
            Rating::create([
                'product_id' => $request->productID,
                'user_id' => $request->userID,
                'rating_count' => $request->course_rating
            ]);
        } else {
            Rating::where('product_id',$request->productID)
                    ->where('user_id',$request->userID)
                    ->update(['rating_count' => $request->course_rating]);
        }

        return back();
    }

    // cart
    public function cartPage(){
        $id = Auth::user()->id;
        $cart = Cart::select('carts.*','users.id as userID','products.id as productID','products.name','products.image','products.price')
                    ->leftJoin('users','carts.user_id','users.id')
                    ->leftJoin('products','carts.product_id','products.id')
                    ->where('carts.user_id',$id)
                    ->get();
        // dd($cart->toArray());

        $subTotal = 0;
        foreach ($cart as $item){
            $subTotal += $item->price * $item->qty;
        }

        return view('user.cart',compact('cart','subTotal'));
    }

    // add to Cart
    public function addToCart(Request $request){
        $userId = Auth::user()->id;
        $productId = $request->productId;
        $qty = $request->qty;

        Cart::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'qty' => $qty,
        ]);

        Alert::success('Add to Cart Success', 'Product successfully Added to your Cart....');
        return to_route('itemDetails',$productId);
    }

    // Remove from cart
    public function removeCart(Request $request){
        // logger($request->all());
        Cart::where('id',$request->cartId)->delete();

        $serverResponse = [
            'message' => 'success'
        ];

        return response()->json($serverResponse, 200);

    }

    // order
    public function order(Request $request){
        // logger($request->all());
        $orderArr = [];
        foreach($request->all() as $item){

            array_push($orderArr,[
                'product_id' => $item['product_id'],
                'user_id' => $item['user_id'],
                'status' => 0,
                'order_code' => $item['order_code'],
                'total_price' => $item['total_price'],
                'cartId' => $item['cartId'],
                'qty' => $item['qty']
            ]);
        }

        // $request->session()->put('orderList', $orderArr);
        Session::put('orderList',$orderArr);
        // logger(Session::get('orderList'));

        return response()->json([
            "message" => "success",
            "status" => 200
        ], 200);
    }

    // order list
    public function orderList(){
        $orderList = Order::select('orders.*','products.name as productName',Order::raw('SUM(total_price) as total_amount'))
                        ->leftJoin('products','orders.product_id','products.id')
                        ->where('orders.user_id',Auth::user()->id)
                        ->groupBy('order_code')
                        ->orderBy('created_at','desc')
                        ->get();

        // $orderTotals = Order::select('order_code',Order::raw('SUM(total_price * qty) as total_amount'))
        //                 ->groupBy('order_code')
        //                 ->get();
        // dd($orderList);
        return view('user.orderList',compact('orderList'));
    }

    // order detail
    public function orderDetail($orderCode){
        $orderDetail = Order::select('orders.*','products.name as productName','products.image')
                        ->leftJoin('products','orders.product_id','products.id')
                        ->where('orders.order_code',$orderCode)
                        ->orderBy('created_at','desc')
                        ->get();

        $total = 0;
        foreach($orderDetail as $item){
            $total += $item->total_price;
        }
        return view('user.orderDetail',compact('orderDetail','total'));
    }

    // payment
    public function paymentPage(){
        // $orderArr = [];

        // foreach($request->all() as $item){

        //     array_push($orderArr,[
        //         'product_id' => $item['product_id'],
        //         'user_id' => $item['user_id'],
        //         'status' => 0,
        //         'order_code' => $item['order_code'],
        //         'total_price' => $item['total_price'],
        //         'qty' => $item['qty']
        //     ]);

        //     // Cart::where('id',$item['cartId'])->delete();
        // }

        $payment = Payment::get();
        $cartProduct = Session::get('orderList');

        $totalPrice = 0;
        foreach ($cartProduct as $price){
            $totalPrice += $price['total_price'];
        }

        // dd($totalPrice);
        return view('user.payment',compact('payment','cartProduct','totalPrice'));
    }

    public function payment(Request $request){
        $cartProduct = Session::get('orderList');

        // validation
        $validator= $request->validate([
            'customerPhone' => 'required',
            'paySlipImage' => 'required|mimes:jpg,jpeg,png|file',
            'paymentType' => 'required',
        ]);

        // order table import
        foreach($cartProduct as $item){
            Order::create([
                'product_id' => $item['product_id'],
                'user_id' => $item['user_id'],
                'status' => 0,
                'order_code' => $item['order_code'],
                'total_price' => $item['total_price'],
                'qty' => $item['qty']
            ]);

        // delete from cart
        Cart::where('id',$item['cartId'])->delete();
        }

        // import data to  payslipHistory
        $data = [
            'customer_name' => $request['customerName'],
            'phone' => $request['customerPhone'],
            'payment_method' => $request['paymentType'],
            'order_code' => $request['orderCode'],
            'order_amount' => $request['totalPrice']
        ];

        if ( $request->hasFile('paySlipImage') ){
            $fileName = uniqid() . $request->file('paySlipImage')->getClientOriginalName();
            $request->file('paySlipImage')->move( public_path().'/paySlipImages/', $fileName );
            $data['payslip_image'] = $fileName;
        }

        PaySlipHistory::create($data);
        // dd($data);
        return to_route('orderList');
    }
}
