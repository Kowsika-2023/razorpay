<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Errors\SignatureVerificationError;
use Razorpay\Api\Api;

class PaymentgatewayController extends Controller
{
    public function razorpay(Request $request)
    {
        $api = new Api(Config("razorpay.key_id"), Config("razorpay.key_secret"));
        $orderData  = $api->order->create([
            'receipt' => '111',
            'amount' => $request->amount * 100,
            'currency' => 'INR'
        ]); // Creates Razorpay order

        $data = [
            "key"               => Config("razorpay.key_id"),
            "amount"            => $request->amount * 100,
            "order_id"          => $orderData['id'],
        ];
        return response()->json($data, 200);
    }

    function verify(Request $request)
    {
        $success = true;
        $error = "Payment Failed!";

        if (empty($request->razorpay_payment_id) === false) {
            $api = new Api(Config("razorpay.key_id"), Config("razorpay.key_secret"));
            try {
                $attributes = [
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature
                ];
                $api->utility->verifyPaymentSignature($attributes);
            } catch (SignatureVerificationError $e) {
                $success = false;
                $error = 'Razorpay Error : ' . $e->getMessage();
            }
        }

        if ($success === true) {
            // Update database with success data
            // Redirect to success page
            return redirect('/');
        } else {
            // Update database with error data
            // Redirect to payment page with error
            // Pass $error along with route
            return redirect('/');
        }
    }

    public function razorpaypage(){
        return view('razorpay');
    }
}
