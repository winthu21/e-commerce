<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\PaySlipHistory;
use App\Http\Controllers\Controller;

class OrderBoardController extends Controller
{
    //Order Board Page
    public function orderBoardPage(){
        $orderList = Order::select('orders.*','products.name as productName','users.name as userName','users.nickname as userNickname')
                            ->leftJoin('products','orders.product_id','products.id')
                            ->leftJoin('users','orders.user_id','users.id')
                            ->where('status','0')
                            ->groupBy('orders.order_code')
                            ->orderBy('orders.created_at','desc')
                            ->paginate(5);
        // $ordersPrice = Order::select('orders.total_price')->get();

        return view('admin.orderBoard.orderList',compact('orderList'));
    }

    // Order details
    public function orderDetails($order_code){
        $orderDetail = Order::select('orders.*','products.name as productName','users.name as userName','users.nickname as userNickname')
                            ->where('orders.order_code',$order_code)
                            ->leftJoin('products','orders.product_id','products.id')
                            ->leftJoin('users','orders.user_id','users.id')
                            ->get();

        $backFun = Order::select('orders.status')
                        ->where('orders.order_code',$order_code)
                        ->first();

        // dd($orderDetail);
        $totalPrice = 0;
        foreach($orderDetail as $item){
            $totalPrice += $item->total_price;
        }

        $paySlipData = PaySlipHistory::select('pay_slip_histories.*','payments.account_name')
                                    ->leftJoin('payments','pay_slip_histories.payment_method','payments.type')
                                    ->where('order_code',$order_code)
                                    ->first();
        // dd($paySlipData);
        return view('admin.orderBoard.orderDetail',compact('orderDetail','totalPrice','paySlipData','backFun'));
    }

    // order Status Change
    public function orderStatusChange(Request $request){
        // logger($request->all());

        Order::where('order_code',$request->orderCode)
                ->update([
                    'status' => $request->status
                ]);
    }
}
