<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    //admin dashboard access
    public function index(){
        $totalSaleAmount = Order::sum('total_price');

        $userCount = User::where('role','user')->count();

        $pendingRequest = Order::where('status','0')->groupBy('order_code')->get();
        $pendingRequest = count($pendingRequest);

        $soldCount = Order::where('status','1')->groupBy('order_code')->get();
        $soldCount = count($soldCount);

        $productCategory = Category::count();

        $products = Products::count();

        $adminList = User::where('role','admin')->paginate(3);
        $adminCount = User::where('role','admin')->count();
        $userList = User::where('role','user')->paginate(3);
        $userCount = User::where('role','user')->count();
        return view('admin.home',compact('totalSaleAmount','userCount','pendingRequest','soldCount','productCategory','products','adminList','userList','adminCount','userCount'));
    }
}
