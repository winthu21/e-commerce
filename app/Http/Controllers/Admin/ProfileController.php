<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    //Profile Details
    public function profileDetailsPage(){
        return view('admin.profile.details');
    }

    // profile update
    public function profileDetailsUpdate(Request $request){
        $adminData = $this->requestAdminData($request);
        // dd($adminData);
        $this->validationCheck($request);

        if ( $request->hasFile('image') ){
            $oldImageName = $request->oldImage;

            if ($oldImageName!=null){
                if ( file_exists(public_path('/admin/profile_photo/'.$oldImageName)) ){
                    unlink(public_path('/admin/profile_photo/'.$oldImageName));
                }
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move( public_path().'/admin/profile_photo/', $fileName );
            $adminData['profile'] = $fileName;
            // dd($data);
        } else {
            $adminData['profile'] = $request->oldImage;
        }

        User::where('id',Auth::user()->id)->update($adminData);
        Alert::success('Profile Update Success', 'Profile successfully updated....');
        return to_route('adminDashboard');
    }

    // new Admin Account Create Page
    public function adminCreatePage(){
        return view('admin.profile.createAdminAccount');
    }

    // new admin create
    public function adminCreate(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'confirmPassword' => 'required|same:password'
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'provider' => 'simple'
        ];

        User::create($data);
        Alert::success('New Admin Create Success', 'New Admin successfully created....');
        return to_route('adminDashboard');
    }

    // admin accounts profile
    public function eachProfilePage($id){

        $adminProfile = User::where('id',$id)->first();
        // dd($adminProfile);
        return view('admin.profile.accountProfile',compact('adminProfile'));
    }

    // request data
    private function requestAdminData($request){
        $data = [];

        if ( Auth::user()->name != null){
            $data['name'] = $request->name;
        } else {
            $data['nickname'] = $request->name;
        }

        if (Auth::user()->provider == 'simple'){
            $data['email'] = $request->email;
        } else {
            $data['email'] = Auth::user()->email;
        }

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

