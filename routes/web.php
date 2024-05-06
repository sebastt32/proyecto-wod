<?php

use App\Http\Controllers\AuthManager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');

Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/login', [AuthManager::class, 'login'])->name('login');


Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');


// Este grupo de rutas se realiza para agrupar las rutas que se muestran cuando ha iniciado sesion 
Route::group(['middleware' => 'auth'], function (){
    Route::get('/profile', function(){
        return "HI";
       })->name('profile');
});


