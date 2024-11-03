<?php

use App\Http\Controllers\ConfirmEmail;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\doubleAuth;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ForgetPasswordManager;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;

// routes/web.php, api.php or any other central route files you have

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {
            return view('welcome');
        })->name('home');

        Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
        //rutas de confirmacion email
        Route::post('/confirmEmail', [ConfirmEmail::class, 'sendconfirmemail'])->middleware('recaptcha','decrypts')->name('confirm.email');
        Route::post('/confirmEmails', [ConfirmEmail::class, 'setemailconfirm'])->name('confirm.email.last');
        Route::get('/confirmEmailact/{email}', [ConfirmEmail::class, 'activateAcoount'])->name('activate.account');
        //ruta de doble autentificacion
        Route::post('/auth', [doubleAuth::class, 'login'])->name('login.factor');
        //
        Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
        Route::get('/login', [AuthManager::class, 'login'])->name('login');


        Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');
        Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');


        // Este grupo de rutas se realiza para agrupar las rutas que se muestran cuando ha iniciado sesion
        Route::group(['middleware' => 'auth'], function () {
            Route::get('/profile', function () {
                return "HI";
            })->name('profile');

            Route::resource('tenants', TenantController::class)->except('show');
        });

        Route::get('/forget-password', [ForgetPasswordManager::class, "forgetPassword"])->name('forget.password');
        Route::post('/forget-password', [ForgetPasswordManager::class, "forgetPasswordPost"])->name("forget.password.post");
        Route::get("/reset-password/{token}", [ForgetPasswordManager::class, "resetPassword"])->name("reset.password");
        Route::post("/reset-password", [ForgetPasswordManager::class, "resetPasswordPost"])->name("reset.password.post");


        // rutas de autentificacion con facebook
        Route::get('/autho/redirect', [SocialiteController::class, 'redirect'])->name('autho.redirect');

        Route::get('/autho/callback', [SocialiteController::class, 'callback'])->name('autho.callback');

        // rutas de autentificacion con google
        Route::get('/authg/redirect', [SocialiteController::class, 'redirectGoogle'])->name('authg.redirect');

        Route::get('/authg/callback', [SocialiteController::class, 'callbackGoogle'])->name('authg.callback');
    });
}
