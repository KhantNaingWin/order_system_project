<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;

Route::middleware('admin_auth')->group(function(){
//login,Register
Route::redirect('/','loginPage');
Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
Route::get('registerPage',[AuthController::class,'registerPage'])->name('authregisterPage');

});

Route::middleware(['auth'])->group(function () {

//Dashboard
Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

//Admin
Route::middleware(['admin_auth'])->group(function(){
//Category
Route::prefix('category')->group(function(){
    Route::get('list',[CategoryController::class,'list'])->name('category#list');
    Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createpage');
    Route::post('create',[CategoryController::class,'create'])->name('create#category');
    Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
    Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
    Route::post('update',[CategoryController::class,'update'])->name('category#update');
    });

    //Admin Account
    Route::prefix('admin')->group(function(){
        //password
        Route::get('password/changePage',[AdminController::class,'passwordChangePage'])->name('admin#passwordChangepage');
        Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');
        //profile
        Route::get('details',[AdminController::class,'details'])->name('admin#details');
        //edit profile
        Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
        //update
        Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');
        //Admin list
        Route::get('list',[AdminController::class,'list'])->name('admin#list');
        //account delete
        Route::get('delete',[Admincontroller::class,'delete'])->name('admin#delete');
        //Admin Role Change
        Route::get('changeRole/{id}',[AdminController::class,'adminChangeRole'])->name('admin#changerole');
        Route::post('change/role/{id}',[AdminController::class,'change'])->name('admin#change');
    });
    //Products
    Route::prefix('product')->group(function(){
        Route::get('list',[ProductController::class,'list'])->name('product#list');
        Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
        Route::post('create',[ProductController::class,'create'])->name('product#create');
        Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
        Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
        Route::get('update/{id}',[ProductController::class,'update_page'])->name('product#update_page');
        Route::post('update',[ProductController::class,'update'])->name('product#update');
    });
    //Order
    Route::prefix('order')->group(function(){
        Route::get('list',[OrderController::class,'orderList'])->name('order#list');
        Route::get('change/status',[OrderController::class,'changeStatuws'])->name('change#status');
        Route::get('ajax/change/status',[OrderController::class,'ajaxChangeStatus'])->name('ajax#change');
        Route::get('listInfo/{orderCode}',[OrderController::class,'listInfo'])->name('listInfo');
    });
});

});
//Admin list
Route::prefix('user')->group(function(){
    Route::get('list',[UserController::class,'userlist'])->name('user#list');
    Route::get('change/role',[UserController::class,'userChangeRole'])->name('user#changeRole');
});

//User
//Home
Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
    Route::get('/homePage',[UserController::class,'home'])->name('user#home');
    Route::get('/filter/{id}',[UserController::class,'filter'])->name('user#filter');

    Route::prefix('pizza')->group(function(){
        Route::get('/details/{id}',[UserController::class,'pizzaDetails'])->name('pizza#details');
    });
    Route::prefix('cart')->group(function(){
        Route::get('list',[UserController::class,'cartList'])->name('user#pizzaCart');
        Route::get('history',[UserController::class,'history'])->name('user#cartHistory');
    });
    //password change
    Route::prefix('password')->group(function(){
        Route::get('change',[UserController::class,'userPasswordChange'])->name('user#passwordchange');
        Route::post('change',[UserController::class,'changepassword'])->name('user#changepassword');
    });
    Route::prefix('account')->group(function(){
        Route::get('change',[UserController::class,'userAccountChange'])->name('user#accountchange');
        Route::post('change/{id}',[UserController::class,'changeAccount'])->name('user#acountchangepage');
    });
    Route::prefix('ajax')->group(function(){
       Route::get('pizzalist',[AjaxController::class,'pizzalist'])->name('ajax#pizzalist');
       Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
       Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
       Route::get('clearCarts',[AjaxController::class,'clearCarts'])->name('clear#carts');
       Route::get('clearCurrentProduct',[AjaxController::class,'clearCurrentProduct'])->name('clear#CurrentProduct');
       Route::get('increase/viewcount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');
    });
});

