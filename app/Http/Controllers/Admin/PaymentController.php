<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    //payment page
    public function adminPaymentPage(){
        $payment_account = Payment::get();
        return view('admin.payment.payment',compact('payment_account'));
    }

    // create payment
    public function paymentCreate(Request $request){

        $validator=$request->validate([
            'type'=>'required',
            'accountNumber' => 'required|unique:payments,account_number'.$request->id,
            'accountName' => 'required'
        ]);
        // dd($request);
        Payment::create([
            'type'=>$request->type,
            'account_number' => $request->accountNumber,
            'account_name' => $request->accountName,
        ]);

        Alert::success('Payment Create Success', 'New Payment Account created.....');

        return back();
    }
}
