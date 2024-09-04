<?php

namespace App\Services;
use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Events\UserDetail;

use Log;

class UserService implements UserInterface
{

    
    public function userStore($request): User{
        $user = new User;
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->save();

        event(new UserDetail($request)); 
        return $user;

    }

}
?>