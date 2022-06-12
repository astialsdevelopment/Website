<?php

use App\Http\Controllers\AddController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('admin');
});

Route::prefix('admin')->group(function () {
    Route::view('/', 'admin.index')->name('admin')->middleware('auth');
    Route::view('/addOrder', 'admin.add_orders')->name('add_orders')->middleware('auth');
    Route::post('/addOrder', [OrderController::class, 'add_order'])->name('add_orders')->middleware('auth');
    Route::get('/orders', [OrderController::class, 'order'])->name('orders')->middleware('auth');
    Route::view('/bill', 'admin.bill')->name('bill')->middleware('auth');
    Route::get('/billDetails/{id}/{status}', [BillController::class, 'bill_details'])->name('bill_details')->middleware('auth');
    Route::post('/billStatus', [BillController::class, 'bill_status'])->name('bill_status')->middleware('auth');
    Route::view('/addBike', 'admin.add_bike')->name('addBike')->middleware('auth');
    Route::view('/addOrderNo', 'admin.add_order_no')->name('add_order_no')->middleware('auth');
    Route::post('/addBike', [AddController::class, 'add_bike'])->name('add_bike')->middleware('auth');
    Route::post('/addOrderNo', [AddController::class, 'add_order_no'])->name('add_order_no')->middleware('auth');
    Route::view('/addCustomer', 'admin.add_customer')->name('add_customer')->middleware('auth');
    Route::post('/addCustomer', [CustomerController::class, 'add_customer'])->name('add_customer')->middleware('auth');

    Route::post('/deleteOrder', [OrderController::class, 'delete_order'])->name('delete_orders')->middleware('auth');
    Route::post('/deleteOrderNo', [DeleteController::class, 'delete_order_no'])->name('delete_order_no')->middleware('auth');
    Route::post('/deletebike', [DeleteController::class, 'delete_bike'])->name('delete_bike')->middleware('auth');
    Route::post('/deleteCustomer', [CustomerController::class, 'delete_customer'])->name('delete_customer')->middleware('auth');
    Route::get('/invoice/{id}', [InvoiceController::class,'invoice'])->name('invoice')->middleware('auth');
    Route::get('/payment_date/{id}', [InvoiceController::class,'payment_date'])->name('payment_date')->middleware('auth');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
