<?php

namespace App\Listeners;

use App\Events\UserDetail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class UserProfileListner
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

        $userProfile = new UserProfile;
        $userProfile->first_name = $request['first_name'];
        $userProfile->last_name = $request['last_name'];
        $userProfile->dob = $request['dob'];
        $userProfile->user_id = $user->id;
        $userProfile->save();
        
        // return $userProfile;
    }
}
