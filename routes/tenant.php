<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\ConfirmEmail;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\doubleAuth;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ForgetPasswordManager;
use App\Http\Controllers\Tenancy\TaskController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TwoFactorAuthenticationController;
use Illuminate\Support\Facades\Storage;

use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    //rutas de fortify
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->middleware(['guest'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->middleware(['guest'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->middleware(['guest'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->middleware(['guest'])
        ->name('password.update');


    //rutas double auth fortify
    Route::get('auth/user/2fa', [TwoFactorAuthenticationController::class, 'index'])->name('front.2fa');

    // Rutas de Fortify para el desafío de 2FA
    Route::get('/2fatest', [TwoFactorAuthenticationController::class, 'handleChal'])->name('2fatest.tenant');
    //////////////////////////////////////////////////////


    Route::get('/registration', [AuthManager::class, 'registrationSubDomain'])->name('registration');


    Route::post('/login', [AuthManager::class, 'loginPostSubdomain'])->middleware('recaptchaLogin', '2fa')->name('login.post');


    Route::get('/login', [AuthManager::class, 'loginSubDomain'])->name('login');


    Route::post('/registration', [AuthManager::class, 'registrationPost'])->middleware('recaptcha')->name('registration');
    Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

    Route::get('/', function () {
        return view('welcome');
    })->name('home');


    // Este grupo de rutas se realiza para agrupar las rutas que se muestran cuando ha iniciado sesion
    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', function () {
            return "HI";
        })->name('profile');

        Route::get('/dashboard', function () {
            return view('tenancy.welcome');
        })->name('home');

        Route::resource('tasks', TaskController::class);

        Route::get('/file/{path}', function ($path) {
            return response()->file(Storage::path($path));
        })->where('path', '.*')->name('file');

        Route::post('/user/two-factor-authentication', [TwoFactorAuthenticationController::class, 'enableTwoFactorAuthentication'])
            ->middleware(['auth']);

        Route::delete('/user/two-factor-authentication', [TwoFactorAuthenticationController::class, 'disableTwoFactorAuthentication'])
            ->middleware(['auth']);
    });






    // // rutas de autentificacion con facebook
    // Route::get('/autho/redirect', [SocialiteController::class, 'redirect'])->name('autho.redirect');

    // Route::get('/autho/callback', [SocialiteController::class, 'callback'])->name('autho.callback');

    // // rutas de autentificacion con google
    // Route::get('/authg/redirect', [SocialiteController::class, 'redirectGoogle'])->name('authg.redirect');

    // Route::get('/authg/callback', [SocialiteController::class, 'callbackGoogle'])->name('authg.callback');
});
