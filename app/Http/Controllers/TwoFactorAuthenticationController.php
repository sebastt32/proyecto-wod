<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;
use Laravel\Fortify\Events\TwoFactorAuthenticationEnabled;
use Laravel\Fortify\RecoveryCode;
use Illuminate\Support\Str;
use PragmaRX\Google2FA\Google2FA;

use Laravel\Fortify\Fortify;

class TwoFactorAuthenticationController extends Controller
{

    public function index(){
        return view('auth.two-factor-auth');
    }
    
    public function handleChal (Request $request){
        $email = $request->email;
        $password = $request->password;
       
        return view('auth.two-factor-chalange', compact('email','password'));
    }
    protected $twoFactorProvider;

    public function __construct(TwoFactorAuthenticationProvider $twoFactorProvider)
    {
        $this->twoFactorProvider = $twoFactorProvider;
    }

    public function enableTwoFactorAuthentication(Request $request)
    {
        $user = Auth::user();

        $g2fa = new Google2FA();


        $user->two_factor_secret = encrypt($g2fa->generateSecretKey());
        $user->two_factor_recovery_codes = encrypt(json_encode($this->generateRecoveryCodes()));
        $user->two_factor_confirmed_at = now();
        $user->save();

        return back()->with('status', 'Two-factor authentication enabled.');
    }

    public function disableTwoFactorAuthentication(Request $request)
    {
        $user = Auth::user();

        $user->two_factor_secret = null;
        $user->two_factor_recovery_codes = null;
        $user->two_factor_confirmed_at = null;
        $user->save();

        return back()->with('status', 'Two-factor authentication disabled.');
    }

    protected function generateRecoveryCodes()
    {
        return collect(range(1, 8))->map(function () {
            return Str::random(10) . '-' . Str::random(10);
        })->toArray();
    }
}
