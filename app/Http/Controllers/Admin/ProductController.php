<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    //list page
    public function list(){
        $data = Products::when(request('searchKey'),function($query){
                            $query->whereAny(['products.name','products.price'],'like','%'.request('searchKey').'%');
                            })
                        ->paginate(3);

        return view('admin.product.list',compact('data'));
    }

    // create
    public function createPage(){
        $data = Category::get();
        return view('admin.product.create',compact('data'));
    }

    public function create(Request $request){
        $this->validationCheck($request,"create");
        // dd($request);
        $data = $this->requestProductData($request);
        // DD($data);
        if ( $request->hasFile('image') ){
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move( public_path().'/uploads/', $fileName );
            $data['image'] = $fileName;
            // dd($data);
        }
        Products::create($data);
        Alert::success('Product Create Success', 'Product successfully created....');
        return back();
    }

    // Edit Product Page
    public function edit($id){
        $product = Products::select('products.id','products.name','products.price','products.description','products.category_id','products.count','products.image','categories.name as categoryName')
                        ->leftJoin('categories','products.category_id','=','categories.id')
                        ->where('products.id',$id)->first();
        $categories = Category::get();
        return view('admin.product.edit',compact('product','categories'));
    }

    // Product Update
    public function update(Request $request){
        $this->validationCheck($request,"update");
        $data = $this->requestProductData($request);

        if ( $request->hasFile('image') ){
            $oldImageName = $request->oldImage;
            if ( file_exists(public_path('/uploads/'.$oldImageName)) ){
                unlink(public_path('/uploads/'.$oldImageName));
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move( public_path().'/uploads/', $fileName );
            $data['image'] = $fileName;
            // dd($data);
        } else {
            $data['image'] = $request->oldImage;
        }
        Products::where('id',$request->id)->update($data);
        Alert::success('Product Update Success', 'Product successfully updated....');
        return to_route('productList');
    }

    // Delete Product
    public function delete($id){
        $data = Products::where('id',$id)->delete();
        // dd($data);
        Alert::success('Product Delete Success', 'Product successfully deleted....');
        return to_route('productList');
    }

    // Product Details
    public function detail($id){
        $data = Products::select('products.id','products.name','products.price','products.description','products.category_id','products.count','products.image','categories.name as categoryName')
                        ->leftJoin('categories','products.category_id','=','categories.id')
                        ->where('products.id',$id)->first();

        return view('admin.product.detail',compact('data'));
    }

    // create validation
    private function validationCheck($request,$action){
        $rules = [
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'count' => 'required',
            'description' => 'required',
        ];

        $rules['image'] = $action == "create" ? "required|mimes:jpg,jpeg,png|file" : "mimes:jpg,jpeg,png|file";
        // $rules['name'] = $action == "create" ? "required|unique:products,name" : 'required|unique:products,name'.$request->id;
        // $message = [
        //     'name.required' => 'Name field is required..........',
        // ];
        // dd($rules);
        $validator= $request->validate($rules);
    }

    // Data Collect
    private function requestProductData($request){
        return [
            'name' => $request->name,
            'category_id' => $request->category,
            'price' => $request->price,
            'count' => $request->count,
            'description' => $request->description,
            'image' => $request->image,
        ];
    }
}
