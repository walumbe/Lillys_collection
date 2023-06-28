<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {

        $user_id = auth()->user()->id;
        $order = Order::where('user_id', $user_id)->first(); 
        $user = User::where('id', $user_id)->first();
        $payment = new Payment();
        $payment->amout = $order->total_price;
        $payment->phone_number = $user->phone_number;
        $payment->status = "pending";

        // initiate Mpesa Request
        $mpesa = new Mpesa();

    }

}
