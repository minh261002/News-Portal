<?php

use App\Http\Controllers\Admin\AdminAuthenticationController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AdminAuthenticationController::class, 'login'])->name('login');
Route::post('/login', [AdminAuthenticationController::class, 'handleLogin'])->name('handleLogin');

Route::get('/password/forgot', [AdminAuthenticationController::class, 'forgotPassword'])->name('password.request');
Route::post('/password/forgot', [AdminAuthenticationController::class, 'sendResetLink'])->name('password.email');

Route::get('/password/reset/{token}', [AdminAuthenticationController::class, 'resetPassword'])->name('password.reset');
Route::post('/password/reset/{token}', [AdminAuthenticationController::class, 'handleResetPassword'])->name('password.update');

Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/logout', [AdminAuthenticationController::class, 'logout'])->name('logout');
});