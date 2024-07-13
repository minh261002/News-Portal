<?php

use App\Http\Controllers\Admin\AdminAuthenticationController;
use App\Http\Controllers\Admin\AdsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomeSectionSettingController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubscriberController;
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
    Route::get('/news-pending', [NewsController::class, 'pendingNews'])->name('news-pending');

    Route::get('/home-section-setting', [HomeSectionSettingController::class, 'index'])->name('home-section-setting');
    Route::put('/home-section-setting', [HomeSectionSettingController::class, 'update'])->name('home-section-setting.update');

    Route::get('/ads', [AdsController::class, 'index'])->name('ads');
    Route::put('/ads/{id}', [AdsController::class, 'update'])->name('ads.update');
    Route::resource('subscribers', SubscriberController::class)->only(['index', 'store', 'destroy']);
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::put('/settings/general', [SettingController::class, 'updateGeneralSetting'])->name('general-setting.update');
    Route::put('/settings/seo', [SettingController::class, 'updateSeoSetting'])->name('seo-setting.update');
    Route::put('/settings/appearance', [SettingController::class, 'updateAppearanceSetting'])->name('appearance-setting.update');
    Route::get('/role', [RolePermissionController::class, 'index'])->name('role.index');
    Route::get('/role/create', [RolePermissionController::class, 'create'])->name('role.create');
    Route::post('/role', [RolePermissionController::class, 'store'])->name('role.store');
    Route::get('/role/{id}/edit', [RolePermissionController::class, 'edit'])->name('role.edit');
    Route::put('/role/{id}', [RolePermissionController::class, 'update'])->name('role.update');
    Route::delete('/role/{id}', [RolePermissionController::class, 'destroy'])->name('role.destroy');
    Route::resource('role_user', RoleUserController::class);
});