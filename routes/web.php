<?php

use App\Http\Controllers\DoubleAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\DoubleAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(["auth" , "verified" , "2auth"])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put("/2auth/enable" , [DoubleAuthController::class , "authSwitcher"]);
    Route::get("/2auth/show" , [DoubleAuthController::class , "index"])->name("2fa");
    Route::put("/2auth/validation" , [DoubleAuthController::class , "validate2fa"])->name("2fa.valide");
});

require __DIR__.'/auth.php';
