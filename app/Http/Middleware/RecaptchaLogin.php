<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class RecaptchaLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
        //gestor recaptcha v2
        $acceso = $request->acceso;

        if ($acceso) {
            return $next($request);
        } else {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('captchav2.secret'),
                'response' => $request->input('g-recaptcha-response')
            ])->object();



            if ($response->success) {
            } else {
                return redirect()->to(route("login"))->with("error", "captcha failed 1");
            }

            //gestor recaptcha v3

            //return $request->all();
            // creado para pruebas de su contenido
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('captcha.secret'),
                'response' => $request->input('g-recaptcha-response_v3')
            ])->object();

            //return $response;
            //se ejecuto para pruebas

            if ($response->success && $response->score >= 0.7) {
                return $next($request);
            } else {

                return redirect()->to(route("login"))->with("error", "captcha failed 2");
            }
        }
    }
}
