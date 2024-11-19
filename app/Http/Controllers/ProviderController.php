<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    //redirect socialite
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();

    }

    //callback Socialite
    public function callback($provider){
        $socialUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate([
                'provider'=>$provider,
                'provider_id'=>$socialUser->id,
            ],
            [
                'name'=>$socialUser->name,
                'nickname'=>$socialUser->nickname,
                'email'=>$socialUser->email,
                'provider_token'=>$socialUser->token,
                'role' => 'user'
            ]);

        Auth::login($user);

        if (Auth::user()->role == 'admin'){
            return to_route('adminDashboard');
        }

        if (Auth::user()->role == 'user'){
            return to_route('userHome');
        }
        // return redirect('dashboard');
    }
}
