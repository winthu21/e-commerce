<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class RoleChangeController extends Controller
{
    //Role change page
    public function adminListPage(){
        $data = User::where('role','admin')
                    ->orWhere('role','superadmin')
                    ->paginate(3);
        // dd($data);
        $adminCount = User::where('role','admin')->count();
        $userCount = User::where('role','user')->count();
        return view('admin.rolechange.adminlist',compact('data','adminCount','userCount'));
    }

    // User List Page
    public function userListPage(){
        $data = User::where('role','user')->paginate(3);
        $adminCount = User::where('role','admin')->count();
        $userCount = User::where('role','user')->count();
        return view('admin.rolechange.userlist',compact('data','adminCount','userCount'));
    }

    // Change to Admin
    public function changeToAdmin($id){
        $data = User::where('id',$id)->first();
        $data = [
            'role' => 'admin'
        ];

        User::where('id',$id)->update($data);
        Alert::success('Admin Update Success', 'Admin successfully updated....');
        return to_route('userListPage');
    }

    // Change to User
    public function changeToUser($id){
        $data = User::where('id',$id)->first();
        $data = [
            'role' => 'user'
        ];

        User::where('id',$id)->update($data);
        // နောက်တစ်နည်း
        // User::where('id',$id)->update(['role' => 'user']);
        Alert::success('User Update Success', 'User successfully updated....');
        return to_route('adminListPage');
    }

    // delete account
    public function deleteAccount($id){
        User::where('id',$id)->delete();
        Alert::success('Delete Success', 'Account successfully deleted....');
        return to_route('adminListPage');
    }
}
