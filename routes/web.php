<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DraftOrderController;
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

Route::get('login/', [AuthController::class, 'loginIndex'])->name('login');
Route::post('login/', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {
  Route::get('admin/registration/', [AuthController::class, 'registerIndex'])->name('admin.registration');
  Route::post('employee/registration/', [AuthController::class, 'register'])->name('employee.registration');
  Route::get('logout/', [AuthController::class, 'logout'])->name('logout');
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
  Route::post('draft/order/confirm',[DraftOrderController::class, 'store'])->name('draft.order.confirm');
  
  /** search debit using mobile number */
  Route::post('/search/debit', [OrderController::class, 'searchDebit']);
  /** search product using barcode */
  Route::post('/search/orderItem/barcode', [ProductController::class, 'searchOrderItem']);
  /** get the product wholesale price */
  Route::post('/sellType/product/wholesaleprice', [ProductController::class, 'productWholesalePrice']);
  
  
});



