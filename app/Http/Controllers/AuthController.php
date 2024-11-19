<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //user Register
    public function registerPage(){
        return view('/admin/register');
    }

    //user login
    public function loginPage(){
        return view('/admin/login');
    }
}
