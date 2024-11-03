<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
//use PragmaRX\Google2FA\Google2FA;
use App\Http\Controllers\Controller;
use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Support\Facades\Auth;
// use BaconQrCode\Renderer\ImageRenderer;
// use BaconQrCode\Writer;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
// //use BaconQrCode\Renderer\Image\ImagickImageBackEnd;

// use BaconQrCode\Renderer\RendererStyle\RendererStyle;
//
// use PragmaRX\Google2FAQRCode\Google2FA;




class doubleAuth extends Controller
{
    public function login(Request $request)
    {
        // return $request->all();



        $recaptchav2 = $request->input('g-recaptcha-response');
        $recaptchav3 = $request->input('g-recaptcha-response_v3');
        $passwordCifrado = $request->input('password');
        $emailCifrado = $request->input('email');

        openssl_private_decrypt(base64_decode($passwordCifrado), $passwordDescifrado, file_get_contents(storage_path('keys/private_key.pem')));
        openssl_private_decrypt(base64_decode($emailCifrado), $emailDescifrado, file_get_contents(storage_path('keys/private_key.pem')));



        //verificacion existencia de usuario
        $user = User::where("email", $emailDescifrado)->first();

        //Confirmacion email
        if (!$user->email_verified_at){
            return redirect()->to(route("login"))->with("error", "Verifica tu cuenta para poder ingresar");
        }



        if (!$user) {
            return redirect()->to(route("login"))->with("error", "usuario no existe");
        };

        $passwordDB = $user->password;


        if (Hash::check($passwordDescifrado, $passwordDB)) {
        } else {
            return redirect()->to(route("login"))->with("error", "incorrect password");
        }



        //$googlekey = (new Google2FA)->generateSecretKey();

        $g2fa = new Google2FA();

        if ($user->token_login) {
            $googlekey = $user->token_login;
        } else {
            $googlekey = $g2fa->generateSecretKey();

            DB::table('users')->where('email', $emailDescifrado)->update(
                [
                    'token_login' => $googlekey,
                ]
            );
        }





        $app_name = 'laravel';

        $qrCodeUrl = $g2fa->getQRCodeUrl(
            $app_name,
            $emailDescifrado,
            $googlekey
        );

        $renderer = new ImageRenderer(
            new RendererStyle(250),
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);








        $writer->writeFile($qrCodeUrl, 'qrcode.png');

        $encoded_qr_data = base64_encode($writer->writeString($qrCodeUrl));


        return view("double-auth", compact('encoded_qr_data', 'emailCifrado', 'passwordCifrado', 'recaptchav2', 'recaptchav3'));
    }
}
