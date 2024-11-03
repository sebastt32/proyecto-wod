<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SocialiteController extends Controller
{
    public function redirect()
    {

        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();



        $email = $user->getEmail();
        $name = $user->getName();

        $user = User::where("email", $email)->first();
        if ($user) {
            return redirect()->to(route("login"))->with("error", "usuario ya existe");
        };

        Mail::send("emails.confirm-email", ['email' => $email], function ($message) use ($email) {
            $message->to($email);
            $message->subject("Confirm email");
        });

        return view('passwordSocialite.Facebook_password', compact('email', 'name'));
    }

    ///

    public function redirectGoogle()
    {

        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        $user = Socialite::driver('google')->stateless()->user();



        $email = $user->getEmail();
        $name = $user->getName();



        $user = User::where("email", $email)->first();
        if ($user) {
            return redirect()->to(route("login"))->with("error", "usuario ya existe");
        };

        Mail::send("emails.confirm-email", ['email' => $email], function ($message) use ($email) {
            $message->to($email);
            $message->subject("Confirm email");
        });

        return view('passwordSocialite.Facebook_password', compact('email', 'name'));
    }
}
