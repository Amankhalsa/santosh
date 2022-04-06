<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator, Illuminate\Support\Facades\Redirect, Illuminate\Support\Facades\Response, File;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;

class GoogleLoginController extends Controller
{

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {

        $getInfo = Socialite::driver($provider)->user();

        $user = $this->createUser($getInfo, $provider);
        //Auth::login($user);

        auth('user')->login($user);

        return Redirect::route('home.page')->with('success_msg', 'You are logedin!');

    }

    function createUser($getInfo, $provider)
    {
        $user = User::where('provider_id', $getInfo->id)->orWhere('email' ,$getInfo->email)->first();
        if (!$user) {
            $user = User::create([
                'name' => $getInfo->name,
                'email' => $getInfo->email,
                'password' => encrypt('my-google'),
                'provider' => $provider,

                'provider_id' => $getInfo->id
            ]);
        } else {

            $user->update(['provider' => $provider, 'provider_id' => $getInfo->id]);
        }
        return $user;

    }
}
