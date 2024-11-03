<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class ConfirmEmail extends Controller
{
    function sendconfirmemail(Request $request){
        

        

        $email = $request->email;
        $name = $request->name;
        $password = $request->password;

        $user = User::where("email", $email)->first();
        if ($user) {
            return redirect()->to(route("login"))->with("error", "usuario ya existe");
        };
        

        $data = $request;

        $token = Str::random(64);

        $request->validate([
            'email' => 'required|email',
        ]);

        Mail::send("emails.confirm-email",['email' => $email], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject("Confirm email");
        });

        

        return view("ConfirmEmailView", compact('email','name','password'));

    }

    function activateAcoount($email){
        return view("ConfirmEmailSecondView", compact('email'));
    }

    function setemailconfirm(Request $request){
        
        $email = $request->email;

        DB::table('users')->where('email',$email)->update(
            [
                'email_verified_at' => Carbon::now(),
            ]
        );

        return redirect()->to(route("login"))->with("success", "Cuenta verificada");

    }
}
