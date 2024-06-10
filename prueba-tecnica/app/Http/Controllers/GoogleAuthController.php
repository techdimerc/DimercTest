<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            
            $existingUser = User::where('email', $user->getEmail())->first();
            
            if($existingUser){
                Auth::login($existingUser);
            } else {
                $newUser = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'google_id'=> $user->getId(),
                    // 'password' => encrypt('my-google')
                ]);
                
                Auth::login($newUser);
            }

            return redirect('/dashboard');
        } catch (\Exception $e) {
            return redirect('/login');
        }
    }
}
