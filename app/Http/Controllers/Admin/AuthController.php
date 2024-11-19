<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    //Change Password Page
    public function changePasswordPage(){
        return view('admin.password.changepasswordpage');
    }

    public function changePassword(Request $request){
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

        return to_route('adminDashboard');
        }

        Alert::success('Password Update Fail', 'Old Password unmatched....');

        return to_route('changePasswordPage');
    }
}
