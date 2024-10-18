<?php

use App\Http\Controllers\Auth\AuthenticateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Auth\Middleware\Authenticate;

Route::middleware('guest')->group(function () {
    // ------------------- Register ------------------- //
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    // ------------------- Login ------------------- //

    Route::get('/login', [AuthenticateController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticateController::class, 'store']);
});


Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthenticateController::class, 'destroy'])->name('logout');

}); 

