<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DecryptMiddle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $passwordCifrado = $request->password;
        $emailCifrado = $request->email;
        $fullnameCifrado = $request->name;

        openssl_private_decrypt(base64_decode($passwordCifrado), $passwordDescifrado, file_get_contents(storage_path('keys/private_key.pem')));
        openssl_private_decrypt(base64_decode($emailCifrado), $emailDescifrado, file_get_contents(storage_path('keys/private_key.pem')));
        openssl_private_decrypt(base64_decode($fullnameCifrado), $nameDescifrado, file_get_contents(storage_path('keys/private_key.pem')));

        $request->merge([
            'name' => $nameDescifrado,
            'password' => $passwordDescifrado,
            'email' => $emailDescifrado
        ]);

        return $next($request);
    }
}
