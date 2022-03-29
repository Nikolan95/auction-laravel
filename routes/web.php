<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BidController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('auth.login');
});
Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'is_admin'], function () {
        //admin crud
        Route::get('/admin/dashboard', [AdminController::class, 'index']);
        Route::post('/admin/createproduct', [AdminController::class, 'store'])->name('admin.create');
        Route::get('/admin/editproduct/{id}', [AdminController::class, 'show'])->name('admin.edit');
        Route::put('/admin/updateproduct', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('/admin/productdelete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
    });

    //main page where users lands after login
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    //main page whits sortable prices
    Route::get('/products/{filter}', [ProductController::class, 'filterPrice'])->name('products.filter');
    //user profile
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    //read notifications for users
    Route::post('readNotification', [UserController::class, 'readNotification'])->name('read.notification');
    //add more money to wallet
    Route::post('/addbalance', [UserController::class, 'addBalance'])->name('add.balance');
    //product detail page
    Route::get('/product/{id}', [ProductController::class, 'show']);
    //regular bid
    Route::post('bid', [BidController::class, 'store'])->name('bid');
    //search function by produt title/ description
    Route::get('/search', [ProductController::class, 'search'])->name('product.search');
    //function for enabling autobid
    Route::post('autobid', [BidController::class, 'autobid'])->name('autobid');
});
