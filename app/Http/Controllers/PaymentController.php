<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;
class PaymentController extends Controller
{
//     public function createOrder(Request $request)
//     {
//         Log::info("order");
//         $api = new Api(config('razorpay.key_id'), config('razorpay.key_secret'));

//         $orderData = [
//             'receipt'         => 'rcptid_11',
//             'amount'          => $request->amount * 100, // amount in the smallest currency unit
//             'currency'        => 'INR',
//             'payment_capture' => 1 // auto capture
//         ];
// Log::info("orderData");
// Log::info($orderData);
//         $order = $api->order->create($orderData);

//         return response()->json([
//             'order_id' => $order['id'],
//             'key' => config('razorpay.key_id'),
//             'amount' => $orderData['amount'],
//             'name' => $request->name,
//             'email' => $request->email,
//             'contactNumber' => $request->contactNumber,
//             'description' => 'Testing Description',
//         ]);
//     }

    public function paymentCallback(Request $request)
    {
        $razor_pay = env('RAZORPAY_KEY_ID');
        $order_id = 'order_id_123';
        $payment_id = '1234';
        $signatureStatus = $this->verifySignature($order_id, $payment_id, $request->razorpay_signature);
        Log::info("signatureStatus");
        Log::info($signatureStatus);
        if ($signatureStatus) {
            // Payment is successful
            // Perform your business logic here
            return response()->json(['success' => true]);
        } else {
            // Payment verification failed
            return response()->json(['success' => false]);
        }
    }

    private function verifySignature($orderId, $paymentId, $signature)
    {
        $id = env('RAZORPAY_KEY_ID');
        $secret = env('RAZORPAY_KEY_SECRET');

        $api = new Api($id, $secret);
        $generatedSignature = hash_hmac('sha256', $orderId . "|" . $paymentId, config('razorpay.key_secret'));
        Log::info("generatedSignature");
        Log::info($generatedSignature);
        return $generatedSignature === $generatedSignature;
    }

//     public function paymentPage(){
//         return view('payment');
//     }

    public function index(){
        $order_id = 'order_id_123'; // Replace with your order ID
        $amount = 50000; // Amount in paise

        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        $order  = $api->order->create(array(
            'receipt' => $order_id,
            'amount' => $amount,
            'currency' => 'INR',
        ));
        $order_id = $order['id'];
        $amount = $order['amount'];
        $currency = $order['currency'];
        return view('payment', compact('order_id', 'amount', 'currency'));
    }
}
