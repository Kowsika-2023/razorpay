<?php

namespace App\Listeners;

use App\Events\UserDetail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\Models\UserAddress;
use App\Models\User;
class UserAddressListner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserDetail  $event
     * @return void
     */
    public function handle(UserDetail $event)
    {
        
        $request = $event->request;
        $user = User::where('email',$request['email'])->first();
        
        foreach($request['address'] as $data){
        $userAddress = new UserAddress;
        $userAddress->landmark = $data['landmark'];
        $userAddress->address = $data['address'];
        $userAddress->user_id = $user->id;
        $userAddress->save();
        }

        // return $userAddress;

    }
}
