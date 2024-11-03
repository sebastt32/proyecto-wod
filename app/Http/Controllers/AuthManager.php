<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use PragmaRX\Google2FAQRCode\Google2FA;

//recursos de encriptacion
use App\Encryption;
use Illuminate\Support\Facades\Crypt;

class AuthManager extends Controller
{
    function login()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('login');
    }

    function loginSubDomain()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('tenancy.tenancyLogin');
    }

    //-------------------------------------------------------------------------------------------------------------------

    function registration()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('registration');
    }

    function registrationSubDomain()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('tenancy.tenancyRegister');
    }

    //---------------------------------------------------------------------------------------------------------------------------

    function loginPost(Request $request)
    {
       
        $passwordCifrado = $request->input('password');
        $emailCifrado = $request->input('email');


        openssl_private_decrypt(base64_decode($passwordCifrado), $passwordDescifrado, file_get_contents(storage_path('keys/private_key.pem')));
        openssl_private_decrypt(base64_decode($emailCifrado), $emailDescifrado, file_get_contents(storage_path('keys/private_key.pem')));

        $request->merge([
            'email' => $emailDescifrado,
            'password' => $passwordDescifrado
        ]);




        //verificacion doble autentificacion
        $google2fa = new Google2FA();
        $secret = $request->input('code_verification');
        $userdouble = User::where("email", $emailDescifrado)->first();
        $valid = $google2fa->verifyKey($userdouble->token_login, $secret);

        //metodo para ver si la cuenta esta verificada
        if ($userdouble->email_verified_at) {
        } else {
            return redirect()->to(route("login"))->with("error", "Verificar cuenta");
        }

        if ($valid) {
        } else {
            return redirect()->to(route("login"))->with("error", "Doble autentificacion failed");
        }




        //gestor recaptcha v2




        // $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        //     'secret' => config('captchav2.secret'),
        //     'response' => $request->input('g-recaptcha-response')
        // ])->object();

        // //return $response;

        // if ($response->success) {
        // } else {
        //     return redirect()->to(route("login"))->with("error", "captcha failed");
        // }




        //gestor recaptcha v3

        //return $request->all();
        // creado para pruebas de su contenido
        // $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        //     'secret' => config('captcha.secret'),
        //     'response' => $request->input('g-recaptcha-response_v3')
        // ])->object();

        // //return $response;
        // //se ejecuto para pruebas

        // if ($response->success && $response->score >= 0.7) {
        // } else {
        //     return redirect()->to(route("login"))->with("error", "captcha failed");
        // }

        //fin recaptcha v3

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home'));
        }
        return redirect(route('login'))->with("error", "Login details are incorrect");
    }

    //---------------------------------------------------------------------------------------

    // loginpost para subdominios

    function loginPostSubdomain(Request $request)
    {


        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home'));
        }
        return redirect(route('login'))->with("error", "Login details are incorrect");
    }









    //-------------------------------------------------------------------------------------------

    function registrationPost(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        //estos datos estan incriptados
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if (!$user) {
            return redirect(route('registration'))->with("error", "Registration failed, try again");
        }
        return redirect(route('login'))->with("success", "account created succesfully");
    }

    function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
