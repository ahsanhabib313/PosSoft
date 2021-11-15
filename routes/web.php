<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;


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

/* Route::get('/', function () {
   return 'hello';
}); */

Route::get('login/', [AuthController::class, 'index'])->name('login');
Route::get('register/', [AuthController::class, 'register'])->name('register');
Route::get('/', [HomeController::class, 'index'])->name('home'); 
Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard'); 

/** Category Route **/
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
Route::post('/category/delete', [CategoryController::class, 'destroy'])->name('category.delete');


/** Product Route **/
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');


/** order route */
Route::post('/order/confirm',[OrderController::class, 'store'])->name('order.confirm');

/** search according to mobile number */
Route::post('/search/debit', [OrderController::class, 'searchDebit']);

