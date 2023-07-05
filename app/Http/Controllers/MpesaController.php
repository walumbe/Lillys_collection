<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Order;
use App\Models\Payment;

class MpesaController extends Controller
{
    public function stk()
    {
        $mpesa = new \Safaricom\Mpesa\Mpesa();
        $user_id = auth()->user()->id;
        $user= User::where('id', $user_id)->first();
        $order = Order::where('user_id', $user_id)->first();

        $BusinessShortCode = 174379;
        $Password = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $TransactionType = 'CustomerPayBillOnline';
        $Amount = intval($order->total_price);
        $PartyA = $user->phone; 
        $PartyB = 174379;
        $PhoneNumber = $user->phone;
        $CallBackURL = 'https://ec5e-197-237-91-6.ngrok-free.app/api/mpesa/stk-callback';
        $AccountReference = 'Laravel Mpesa';
        $TransactionDesc = 'Laravel Mpesa STK PUSH';
        $Remarks = 'Laravel Mpesa STK PUSH';


        $stkPushSimulation=$mpesa->STKPushSimulation(
            $BusinessShortCode,
            $Password,
            $TransactionType,
            $Amount,
            $PartyA,
            $PartyB,
            $PhoneNumber,
            $CallBackURL,
            $AccountReference,
            $TransactionDesc,
            $Remarks
        );

        

        $payment_details = json_decode($stkPushSimulation, true);

        $payment = new Payment();
        $payment->user_id = $user_id;
        $payment->checkout_request_id = $payment_details['CheckoutRequestID'];
        $payment->save();
    }

    public function apiResponse(Request $request)
    {
        // $response = json_decode(file_get_contents('php://input'), true);
        $response = json_decode($request->getContent(), true);
        Log::info($response);
        $resData =  $response['Body']['stkCallback']['CallbackMetadata'];
        $responseCode =$response['Body']['stkCallback']['ResultCode'];
        $resMessage =$response['Body']['stkCallback']['ResultDesc'];
        $amountPaid = $resData['Item'][0]['Value'];
        $mpesaTransactionId = $resData['Item'][1]['Value'];
        // $paymentPhoneNumber =$resData[Item[4]]->Valuse;

        $CheckoutRequestID = $response['Body']['stkCallback']['CheckoutRequestID'];
        $mpesaReceiptNumber = $response['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
        
        $payment=Payment::where('checkout_request_id', $CheckoutRequestID)->first();
        $payment->receipt=$mpesaReceiptNumber;
        $payment->amount = $amountPaid;
        $payment->save();

    }
    
}
