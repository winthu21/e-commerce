<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\User\UserDashboardController;

// User
Route::group(['prefix'=>'user','middleware' => ['auth','user'] ],function(){
    Route::get('/home',[ UserDashboardController::class,'index'])->name('userHome');
    Route::get('/shop/{category_id?}',[ShopController::class,'shop'])->name('shopList');
    Route::get('/shop/details/{id}',[ShopController::class,'details'])->name('itemDetails');
    Route::post('/shop/details/comment',[ShopController::class,'comment'])->name('comment');
    Route::post('/shop/details/rating',[ShopController::class,'addRating'])->name('addRating');
    Route::get('cartPage',[ShopController::class,'cartPage'])->name('cartPage');
    Route::post('/shop/details/addToCart',[ShopController::class,'addToCart'])->name('addToCart');
    Route::get('cartPage/removeCart',[ShopController::class,'removeCart'])->name('removeCart');
    Route::get('order',[ShopController::class,'order'])->name('order');
    Route::get('orderList',[ShopController::class,'orderList'])->name('orderList');
    Route::get('orderDetail/{orderCode}',[ShopController::class,'orderDetail'])->name('orderDetail');
    Route::get('paymentPage',[ShopController::class,'paymentPage'])->name('paymentPage');
    Route::post('payment',[ShopController::class,'payment'])->name('payment');
    Route::get('profilePage',[UserDashboardController::class,'profilePage'])->name('profilePage');
    Route::get('profileEditPage',[UserDashboardController::class,'profileEditPage'])->name('profileEditPage');
    Route::post('profileUpdate',[UserDashboardController::class,'profileUpdate'])->name('profileUpdate');
    Route::get('changeUserPswPage',[UserDashboardController::class,'changeUserPswPage'])->name('changeUserPswPage');
    Route::post('changeUserPsw',[UserDashboardController::class,'changeUserPsw'])->name('changeUserPsw');
});



