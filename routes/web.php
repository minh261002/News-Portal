<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
require __DIR__ . '/auth.php';

Route::get('language', LanguageController::class)->name('language');
Route::get('blog/{slug}', [HomeController::class, 'detail'])->name('news.detail');
Route::post('comment', [HomeController::class, 'handleComment'])->name('comment');
Route::post('getComment', [HomeController::class, 'getComments'])->name('getComments');
Route::delete('comment/{id}', [HomeController::class, 'deleteComment'])->name('deleteComment');
Route::get('/news', [HomeController::class, 'news'])->name('news');
Route::post('/register-newsletter', [HomeController::class, 'registerNewsletter'])->name('register-newsletter');