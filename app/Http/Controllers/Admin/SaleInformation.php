<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleInformation extends Controller
{
    //Sale Info Page
    public function saleInfo(){
        $saleInfo = Order::select('orders.*','products.name as productName','users.name as userName','users.nickname as userNickname')
                        ->leftJoin('products','orders.product_id','products.id')
                        ->leftJoin('users','orders.user_id','users.id')
                        ->where('status','1')
                        ->orWhere('status','2')
                        ->groupBy('orders.order_code')
                        ->orderBy('orders.created_at','desc')
                        ->paginate(5);
        // dd($saleInfo->toArray());
        return view('admin.saleInformation.saleInfo',compact('saleInfo'));
    }
}
