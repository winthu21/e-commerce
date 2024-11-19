<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;

// auth
require __DIR__.'/auth.php';

// admin
require_once __DIR__.'/admin.php';

// user
require_once __DIR__.'/user.php';

Route::middleware('admin')->group(function(){
    // login
    Route::redirect('/', '/auth/login');
    Route::get('/auth/login',[ AuthController::class,'loginPage'])->name('userLogin');
    // Register
    Route::get('/auth/register',[ AuthController::class,'registerPage'])->name('userRegister');
});

// Google and Github login
Route::get('/auth/{provider}/redirect',[ ProviderController::class,'redirect']);
Route::get('/auth/{provider}/callback',[ ProviderController::class,'callback']);




