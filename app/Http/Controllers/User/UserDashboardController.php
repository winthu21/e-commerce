<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Review;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserDashboardController extends Controller
{
    // shopHome
    public function index(){
        $products = Products::when(request('searchKey'),function($query){
                    $query = whereAny(['products.name'],'like','%'.request('searchKey').'%');
                    })
                    ->paginate(12);

        $products = Products::select('products.*','categories.id','categories.name as category_name')
                            ->leftJoin('categories','products.category_id','categories.id')
                            ->paginate(12);

        $productsCount = Products::select('products.*','categories.id','categories.name as category_name')
                            ->leftJoin('categories','products.category_id','categories.id')
                            ->count();

        $clientSay = Review::select('reviews.*','users.name','users.nickname','users.role','users.profile','products.name as productName')
                            ->leftJoin('users','reviews.user_id','users.id')
                            ->leftJoin('products','reviews.product_id','products.id')
                            ->get();

        $fruits = Products::select('products.name','products.image')
                            ->leftJoin('categories','products.category_id','categories.id')
                            ->where('categories.id',5)
                            ->get();

        // dd($fruits->toArray());
        // dd($clientSay->toArray());
        // dd($clientSay);
        $category = Category::get();
        $customer = User::where('role','user')->count();
        // dd($category->toArray());
        // dd($products->get());
        return view('user.home',compact('products','category','customer','productsCount','clientSay','fruits'));
    }

    // user Profile
    public function profilePage(){
        $user = User::where('id',Auth::user()->id)->first();

        // dd($user->toArray());
        return view('user.profile',compact('user'));
    }

    // Profile Edit Page
    public function profileEditPage(){
        $user = User::where('id',Auth::user()->id)->first();
        return view('user.profileEdit',compact('user'));
    }

    // profile update
    public function profileUpdate(Request $request){
        $userData = $this->requestAdminData($request);
        // dd($userData);
        $this->validationCheck($request);

        if ( $request->hasFile('image') ){
            $oldImageName = $request->oldImage;

            if ($oldImageName!=null){
                if ( file_exists(public_path('/user/profile_photo/'.$oldImageName)) ){
                    unlink(public_path('/user/profile_photo/'.$oldImageName));
                }
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move( public_path().'/user/profile_photo/', $fileName );
            $userData['profile'] = $fileName;
            // dd($data);
        } else {
            $userData['profile'] = $request->oldImage;
        }

        // dd($userData);
        User::where('id',Auth::user()->id)->update($userData);
        Alert::success('Profile Update Success', 'Profile successfully updated....');
        return to_route('profilePage');
    }

    // password change page
    public function changeUserPswPage(){
        return view('user.passwordChange');
    }

    // password change
    public function changeUserPsw(Request $request){
        // dd($request);
        $validator = $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword',
        ]);
        $hashDBpassword = User::select('password')
                                ->where('id',Auth::user()->id)->first();
        $hashDBpassword = $hashDBpassword['password'];
        // dd($hashDBpassword);
        $oldPassword = $request->oldPassword;

        if (Hash::check($oldPassword, $hashDBpassword)){
            $user = [
                'password'=>Hash::make($request->newPassword),
            ];
            User::where('id',auth()->user()->id)->update($user);

        Alert::success('Password Update Success', 'Password successfully updated....');

        return to_route('profilePage');
        }

        Alert::success('Password Update Fail', 'Old Password unmatched....');

        return to_route('changeUserPswPage');
    }

    // request data
    private function requestAdminData($request){
        $data = [];

        if ( Auth::user()->name != null){
            $data['name'] = $request->name;
        } else {
            $data['nickname'] = $request->name;
        }

        // if (Auth::user()->provider == 'simple'){
        //     $data['email'] = $request->email;
        // } else {
        //     $data['email'] = Auth::user()->email;
        // }

        $data['email'] = Auth::user()->provider == 'simple' ? $request->email : Auth::user()->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;

        return $data;
    }

    // validation check
    private function validationCheck($request){
        $rules = [
            // 'name' => 'required',
            // 'email' => 'required|unique:users,email,'.Auth::user()->id,
            'phone' => 'required|unique:users,phone,'.Auth::user()->id,
            'address' => 'required',
        ];

        if (Auth::user()->provider == 'simple'){
            $rules['name'] = 'required';
        }
        $rules['email'] = Auth::user()->provider == 'simple' ? 'required|unique:users,email,'.Auth::user()->id : 'unique:users,email,'.Auth::user()->id;

        $validator= $request->validate($rules);
    }
}
