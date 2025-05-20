<?php

use App\Http\Controllers\View\LoginController;
use App\Http\Controllers\View\TryOutController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'loginPage'])->name('login.page');
Route::get('/register', [LoginController::class, 'registerPage'])->name('register.page');
Route::get('/tryout', [TryOutController::class, 'tryOutPage'])->name('tryOut.page');
