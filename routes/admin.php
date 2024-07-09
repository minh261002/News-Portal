<?php

use App\Http\Controllers\Admin\AdminAuthenticationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProfileController;
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

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'changePassword'])->name('profile.password');

    Route::resource('languages', LanguageController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('new', NewsController::class);

    Route::get('fetch-news-category', [NewsController::class, 'fetchNewsCategory'])->name('fetch-news-category');
    Route::get('/news/toggle-status', [NewsController::class, 'toggleNewsStatus'])->name('toggle-news-status');
    Route::get('/news-copy/{id}', [NewsController::class, 'newsCopy'])->name('news-copy');
});
