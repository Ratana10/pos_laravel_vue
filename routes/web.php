<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ExchangeController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PosController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Test\SaleTestController;
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


Route::prefix('/api/v1')->group(function (){
    
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customers', 'index')->name('customers.index');
        Route::post('/customers', 'store')->name('customers.store');
        Route::put('/customers/{customer}', 'update')->name('customers.update');
        Route::delete('/customers/{customer}', 'destory')->name('customers.destory');
        Route::get('/customers-search', 'search')->name('customers.search');
    });

    Route::controller(SupplierController::class)->group(function () {
        Route::get('/suppliers', 'index')->name('suppliers.index');
        Route::post('/suppliers', 'store')->name('suppliers.store');
        Route::put('/suppliers/{supplier}', 'update')->name('suppliers.update');
        Route::delete('/suppliers/{supplier}', 'destory')->name('suppliers.destory');
        
        Route::get('/suppliers/search', 'search')->name('suppliers.search');

    });
    
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories.index');
        Route::post('/categories', 'store')->name('categories.store');
        Route::put('/categories/{category}', 'update')->name('categories.update');
        Route::delete('/categories/{category}', 'destory')->name('categories.destory');
    });

    Route::controller(ExchangeController::class)->group(function () {
        Route::get('/exchanges', 'index')->name('exchanges.index');
        Route::post('/exchanges', 'store')->name('exchanges.store');
        Route::put('/exchanges/{exchange}', 'update')->name('exchanges.update');
        Route::delete('/exchanges/{exchange}', 'destory')->name('exchanges.destory');
    });

    Route::controller(UnitController::class)->group(function () {
        Route::get('/units', 'index')->name('units.index');
        Route::post('/units', 'store')->name('units.store');
        Route::put('/units/{unit}', 'update')->name('units.update');
        Route::delete('/units/{unit}', 'destory')->name('units.destory');
        Route::get('/units-search', 'search')->name('units.search');

    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('products.index');
        Route::get('/products/{product}/edit', 'edit')->name('products.edit');
        Route::post('/products', 'store')->name('products.store');
        Route::put('/products/{product}', 'update')->name('products.update');
        Route::delete('/products/{product}', 'destory')->name('products.destory');

        Route::get('/products-code', 'generateCode')->name('products.code');
        Route::get('/products/search', 'search')->name('products.search');
    });

    Route::controller(PaymentController::class)->group(function () {
        Route::get('/payments', 'index')->name('payments.index');
        Route::post('/payments', 'store')->name('payments.store');
        Route::get('/payments-check', 'checkPaymentToUpdateStatus')->name('payments.checkPaymentToUpdateStatus');

    });

    Route::controller(SaleController::class)->group(function () {
        Route::get('/sales', 'index')->name('sales.index');
        Route::get('/sales-status', 'getNumberOfSaleStatus')->name('sales.status');
    });

    Route::controller(PosController::class)->group(function () {
        Route::get('/pos', 'index')->name('pos.index');
        Route::post('/pos', 'store')->name('pos.store');

    });
    
    Route::controller(SaleTestController::class)->group(function () {
        Route::get('/sales/test', 'index')->name('salestest.index');
    });

    Route::controller(PurchaseController::class)->group(function () {
        Route::post('/purchases', 'store')->name('purchases.store');
        Route::get('/purchases-code', 'generateCode')->name('purchases.code');
    });

    
});


Route::get('{view}', ApplicationController::class)->where('view', '(.*)');