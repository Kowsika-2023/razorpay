<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogicalController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentgatewayController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Fhsinchy\Inspire\Controllers;
use Fhsinchy\Inspire\Controllers\InspirationController;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('/export-users', [UserController::class,'exportSelectedUsers'])->name('export.users');

Route::resource('/',LogicalController::class);
Route::resource('ajax',AjaxController::class);
Route::resource('users',UserController::class);

Route::get('user/store',[UserController::class,'store']);
Route::get('admindatatables',[UserController::class,'index'])->name('admindatatables');

// Route::get('paymentpage',[PaymentController::class,'index'])->name('payment.page');


// Route::get('/pay/razorpay', [PaymentgatewayController::class,'razorpaypage'])->name('pay.razorpay');
// Route::post('/pay/verify', [PaymentgatewayController::class, 'verify']);

// Route::get('/', function () {
//     return view('app');
// });


// Route::post('razorpaymethod',[PaymentgatewayController::class,'razorpay'])->name('razorpaymethod');

Route::get('/payment-initiate',function(){
    return view('payment1');
});
Route::post('/payment-initiate-request',[RazorpayController::class,'Initiate'])->name('payment-initiate-request');
Route::post('/payment-complete',[RazorpayController::class,'Complete']);
Route::get('complete',[RazorpayController::class,'complete'])->name('complete');

Route::get('complete/page',[RazorpayController::class,'completepage'])->name('completedpage');



// Route::get('inspire', function(Fhsinchy\Inspire\Inspire $inspire) {
//     return $inspire->justDoIt();
// });
// Route::get('inspire', InspirationController::class);

Route::get('auth/google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('auth/google/callback', function () {
    $user = Socialite::driver('google')->user();

    // $user->token
});

Route::get('auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    // Check if the user exists in your database
    $user = User::where('email', $googleUser->email)->first();

    if ($user) {
        // Log the user in
        Auth::login($user);
    } else {
        // Create a new user in your database
        $user = User::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'google_id' => $googleUser->id,
            // Optionally, you can store the token, avatar, etc.
        ]);

        Auth::login($user);
    }

    // Redirect to the intended page or dashboard
    return redirect()->intended('/');
});

