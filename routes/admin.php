<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\SaleInformation;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderBoardController;
use App\Http\Controllers\Admin\RoleChangeController;
use App\Http\Controllers\Admin\AdminDashboardController;

// admin
Route::group(['prefix'=>'admin','middleware' => ['auth','admin'] ],function(){
    Route::get('/home',[ AdminDashboardController::class,'index'])->name('adminDashboard');

    // admin group ထဲက category group (group ရေးနည်းနောက်တစ်နည်း)
    Route::prefix('category')->group(function () {
        Route::get('list',[CategoryController::class,'list'])->name('categoryList');
        Route::get('create',[CategoryController::class,'createPage'])->name('categoryCreate');
        Route::post('create',[CategoryController::class,'create'])->name('create');
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('categoryDelete');
        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('categoryEdit');
        Route::post('update',[CategoryController::class,'update'])->name('categoryUpdate');
    });

    Route::prefix('product')->group(function(){
        Route::get('list',[ProductController::class,'list'])->name('productList');
        Route::get('create',[ProductController::class,'createPage'])->name('productCreatePage');
        Route::post('create',[ProductController::class,'create'])->name('productCreate');
        Route::get('detail/{id}',[ProductController::class,'detail'])->name('productDetail');
        Route::get('delete/{id}',[ProductController::class,'delete'])->name('productDelete');
        Route::get('edit/{id}',[ProductController::class,'edit'])->name('productEdit');
        Route::post('update',[ProductController::class,'update'])->name('productUpdate');
    });

    Route::prefix('password')->group(function(){
        Route::get('change',[AuthController::class,'changePasswordPage'])->name('changePasswordPage');
        Route::post('change',[AuthController::class,'changePassword'])->name('changePassword');
    });

    Route::prefix('profile')->group(function(){
        Route::get('details',[ProfileController::class,'profileDetailsPage'])->name('profileDetailsPage');
        Route::post('details',[ProfileController::class,'profileDetailsUpdate'])->name('profileUpdate');
        Route::get('account/create',[ProfileController::class,'adminCreatePage'])->name('adminCreatePage');
        Route::post('account/create',[ProfileController::class,'adminCreate'])->name('adminCreate');
        Route::get('eachProfilePage/{id}',[ProfileController::class,'eachProfilePage'])->name('eachProfilePage');
    });

    Route::prefix('rolelist')->group(function(){
        Route::get('admin',[RoleChangeController::class,'adminListPage'])->name('adminListPage');
        Route::get('user',[RoleChangeController::class,'userListPage'])->name('userListPage');
        Route::get('change/admin/{id}',[RoleChangeController::class,'changeToAdmin'])->name('changeToAdmin');
        Route::get('change/user/{id}',[RoleChangeController::class,'changeToUser'])->name('changeToUser');
        Route::get('delete/{id}',[RoleChangeController::class,'deleteAccount'])->name('deleteAccount');
    });

    // payment
    Route::prefix('payment')->group(function(){
        Route::get('adminPaymentPage',[PaymentController::class,'adminPaymentPage'])->name('adminPaymentPage');
        Route::post('paymentCreate',[PaymentController::class,'paymentCreate'])->name('paymentCreate');
    });

    Route::prefix('orderBoard')->group(function(){
        Route::get('orderBoardPage',[OrderBoardController::class,'orderBoardPage'])->name('orderBoardPage');
        Route::get('orderStatusChange',[OrderBoardController::class,'orderStatusChange'])->name('orderStatusChange');
        Route::get('orderDetails/{order_code}',[OrderBoardController::class,'orderDetails'])->name('orderDetails');
    });

    Route::prefix('sale')->group(function(){
        Route::get('saleInfo',[SaleInformation::class,'saleInfo'])->name('saleInfo');
    });
});
