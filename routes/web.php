<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/home', [App\Http\Controllers\AdminController::class, 'home'])->name('adminHome');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product_detail/{id}', [App\Http\Controllers\HomeController::class, 'productDetail'])->name('productDetail');
Route::get('/showCart', [App\Http\Controllers\HomeController::class, 'showCart'])->name('showCart');
Route::get('/deleteCart/{id}', [App\Http\Controllers\HomeController::class, 'deleteCart'])->name('deleteCart');
Route::post('/update-cart', [App\Http\Controllers\HomeController::class, 'updateCart'])->name('updateCart');
Route::post('/addToCartFromDetail', [App\Http\Controllers\HomeController::class, 'addToCartFromDetail'])->name('addToCartFromDetail');
Route::get('/checkout', [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout');
Route::get('/cancel/{id}', [App\Http\Controllers\HomeController::class, 'cancel'])->name('cancel');
Route::post('/order', [App\Http\Controllers\HomeController::class, 'order'])->name('order');
Route::get('/orderStatus', [App\Http\Controllers\HomeController::class, 'orderStatus'])->name('orderStatus');
Route::get('/shop', [App\Http\Controllers\HomeController::class, 'shop'])->name('shop');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::post('/searchByName', [App\Http\Controllers\HomeController::class, 'searchByName'])->name('searchByName');

Route::get('/category/{slug}', [App\Http\Controllers\HomeController::class, 'searchCategory'])->name('searchCategory');



// login
Route::get('/login',[App\Http\Controllers\AdminController::class, 'index'])->name('login.index');
Route::post('/loginHandling',[App\Http\Controllers\AdminController::class, 'loginHandling'])->name('login.loginHandling');
Route::get('/logout',[App\Http\Controllers\AdminController::class, 'logoutHandling'])->name('login.logoutHandling');

Route::get('/testtheme', function () {
    return view('layouts.admin');
});

