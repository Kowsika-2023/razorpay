<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogicalController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentgatewayController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('login',[UserController::class,'login']);
// Route::group(['middleware' => ['auth:sanctum']], function ()
    // {
Route::resource('logicals',LogicalController::class);

Route::get('logical-list',[LogicalController::class,'list']);
    // });

 Route::resource('users',UserController::class);
 Route::post('/products', [ProductController::class, 'store']);
 Route::post('/create-order', [PaymentController::class, 'createOrder']);
 Route::post('/payment-callback', [PaymentController::class, 'paymentCallback']);


 Route::post('payment/razorpay', [PaymentgatewayController::class, 'razorpay'])->name('paymentRazorpay');
