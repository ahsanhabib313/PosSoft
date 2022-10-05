<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DraftOrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeePaymentController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionTypeController;

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
Route::get('/', [AuthController::class, 'index']);
Route::prefix('user/')->name('user.')->group(function(){

    Route::middleware(['guest:web','preventBackHistory'])->group(function(){

      Route::get('login/', [AuthController::class, 'loginIndex'])->name('login');
      Route::post('login/check', [AuthController::class, 'login'])->name('login.check');
      Route::view('register', 'user.register')->name('register');
      Route::post('register/', [AuthController::class, 'register'])->name('register');

    });
    Route::middleware(['auth:web','preventBackHistory'])->group(function(){

      Route::get('dashboard/', [HomeController::class, 'index'])->name('dashboard'); 
      Route::post('order/confirm',[OrderController::class, 'store'])->name('order.confirm');
      Route::post('get/product',[HomeController::class, 'getProduct'])->name('get.product');
      Route::post('/search/debit',[OrderController::class, 'searchDebit'])->name('search.debit');
      Route::post('search/orderItem/barcode',[ProductController::class, 'searchOrderItem'])->name('search.orderItem.barcode');
      Route::post('draft/order/confirm',[DraftOrderController::class, 'store'])->name('draft.order.confirm');
      /** get the product wholesale price */
      Route::post('/sellType/product/wholesaleprice', [ProductController::class, 'productWholesalePrice']);

       //get the product according to category
      Route::post('get/product',[HomeController::class, 'getproduct'])->name('get.product');
      Route::get('get/invoice/pdf',[OrderController::class, 'getInvoice'])->name('get.invoice.pdf');

      Route::get('logout/', [AuthController::class, 'logout'])->name('logout');


    });

});
Route::prefix('admin/')->name('admin.')->group(function(){

    Route::middleware(['guest:admin','preventBackHistory'])->group(function(){

            Route::view('login/', 'admin.login')->name('login');
            Route::post('login/check', [AdminController::class, 'login'])->name('login.check');
            Route::view('register/', 'admin.register')->name('register');
            Route::post('register/', [AdminController::class,'register'])->name('register');
 

    });
    Route::middleware(['auth:admin','preventBackHistory'])->group(function(){

              
            
            Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard'); 

            /** show notifications  **/
            Route::get('/show/notification/',[AdminController::class, 'showNotification'])->name('show.notification');
            /** mark the notifications as read  **/
            Route::get('/notification/mark/read',[AdminController::class, 'markAsReadNotification'])->name('notification.mark.read');
            
            /** Category Route **/
            Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
            Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
            Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
            Route::post('/category/delete', [CategoryController::class, 'destroy'])->name('category.delete');
            Route::post('/search/category/',[CategoryController::class, 'search'])->name('search.category');
            
            
            /** Product Route **/
            Route::get('/product', [ProductController::class, 'index'])->name('product.index');
            Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
            Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');
            Route::post('/product/delete', [ProductController::class, 'destroy'])->name('product.delete');
            Route::post('/search/product/',[ProductController::class, 'search'])->name('search.product');
            
            
            /** order route */
            Route::get('order/show',[OrderController::class, 'index'])->name('order.show');
            Route::post('/search/order/',[OrderController::class, 'search'])->name('search.order');
           
            Route::get('/view/order/items/{id}',[OrderController::class, 'viewOrderItems'])->name('view.order.items');
            Route::post('/order/delete',[OrderController::class, 'destroy'])->name('delete.order');

            
            /** search debit using mobile number */
            Route::post('/search/debit', [OrderController::class, 'searchDebit']);
            /** search product using barcode */
            Route::post('/search/orderItem/barcode', [ProductController::class, 'searchOrderItem']);
            /** get the product wholesale price */
            Route::post('/sellType/product/wholesaleprice', [ProductController::class, 'productWholesalePrice']);


            //get the product according to category
            Route::post('get/product',[HomeController::class, 'getproduct'])->name('get.product');
            Route::get('get/invoice/pdf',[OrderController::class, 'getInvoice'])->name('get.invoice.pdf');


            /********** designation route **************/
            Route::get('/designation', [DesignationController::class, 'index'])->name('designation');
            Route::post('/designation/store', [DesignationController::class, 'store'])->name('designation.store');
            Route::post('/designation/update', [DesignationController::class, 'update'])->name('designation.update');
            Route::post('/designation/delete', [DesignationController::class, 'destroy'])->name('designation.delete');
            
            /********** bank route **************/
            Route::get('/bank', [BankController::class, 'index'])->name('bank');
            Route::post('/bank/store', [BankController::class, 'store'])->name('bank.store');
            Route::post('/bank/update', [BankController::class, 'update'])->name('bank.update');
            Route::post('/bank/delete', [BankController::class, 'destroy'])->name('bank.delete');

            /********** merchant route **************/
            Route::get('/merchant', [MerchantController::class, 'index'])->name('merchant');
            Route::post('/merchant/store', [MerchantController::class, 'store'])->name('merchant.store');
            Route::post('/merchant/update', [MerchantController::class, 'update'])->name('merchant.update');
            Route::post('/merchant/delete', [MerchantController::class, 'destroy'])->name('merchant.delete');


            /********** employee route **************/
            Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
            Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
            Route::post('/employee/update', [EmployeeController::class, 'update'])->name('employee.update');
            Route::post('/employee/delete', [EmployeeController::class, 'destroy'])->name('employee.delete');

            /********** employee payment route **************/
            Route::get('/employee/payment', [EmployeePaymentController::class, 'index'])->name('employee.payment');
            Route::post('/employee/payment/store', [EmployeePaymentController::class, 'store'])->name('employee.payment.store');
            Route::post('/employee/payment/update', [EmployeePaymentController::class, 'update'])->name('employee.payment.update');
            Route::post('/employee/payment/delete', [EmployeePaymentController::class, 'destroy'])->name('employee.payment.delete');
            Route::post('/employee/payment/search/', [EmployeePaymentController::class, 'search'])->name('employee.payment.search');

            /** transaction type Route **/
            Route::get('/transactionType', [TransactionTypeController::class, 'index'])->name('transactionType.index');
            Route::post('/transactionType/store', [TransactionTypeController::class, 'store'])->name('transactionType.store');
            Route::post('/transactionType/update', [TransactionTypeController::class, 'update'])->name('transactionType.update');
            Route::post('/transactionType/delete', [TransactionTypeController::class, 'destroy'])->name('transactionType.delete');
            Route::post('/search/transactionType/',[TransactionTypeController::class, 'search'])->name('search.transactionType');
            

            /********** transaction route **************/
            Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');
            Route::post('/transaction/store', [TransactionController::class, 'store'])->name('transaction.store');
            Route::post('/transaction/update', [TransactionController::class, 'update'])->name('transaction.update');
            Route::post('/transaction/delete', [TransactionController::class, 'destroy'])->name('transaction.delete');
            Route::get('logout/', [AdminController::class, 'logout'])->name('logout');
            


    });

});






  




