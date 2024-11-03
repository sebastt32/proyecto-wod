<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use PragmaRX\Google2FAQRCode\Google2FA;

use Illuminate\Support\Facades\Redirect;

class doubleAuthFortify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        $email = $request->email;
        //verificacion existencia de usuario
        $user = User::where("email", $email)->first();

        //Confirmacion email
        if (!$user) {
            return redirect()->to(route("login"))->with("error", "No existe el usuario");
        }

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where("email", $email)->first();

        if (!$user->two_factor_secret) {
            $validation = 0;
        } else {
            $validation = $user->two_factor_secret;
            $validation = decrypt($validation);
        }


        if (!$validation) {

            return $next($request);
        }

        $acces = $request->input('acceso');


        if ($acces) {

            $google2fa = new Google2FA();
            $secret = $request->input('code');
            $userdouble = User::where("email", $email)->first();
            $valid = $google2fa->verifyKey($validation, $secret);


            if ($valid) {
                return $next($request);
            } else {
                return redirect()->to(route("login"))->with("error", "Doble autentificacion failed");
            }
        }
        return redirect()->route('2fatest.tenant', compact('email', 'password'));
    }
}
