<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\HomeSliderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
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
    // return view('frontend.index');
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::controller(AdminController::class)->group(function () {
//     Route::post('/admin/store', 'store');
//     Route::get('/admin/dashboard', 'adminDashboard')->middleware(['auth', 'verified'])->name('admin.dashboard');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware('auth')->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::post('/admin/logout', 'destroy')->name('admin.logout');
        Route::get('/admin/profile', 'adminProfileView')->name('admin.profile');
        Route::get('/admin/profile/edit', 'adminProfileEdit')->name('admin.profile.edit');
        Route::post('/admin/profile/update', 'adminProfileUpdate')->name('admin.profile.update');
        Route::get('/admin/change/password', 'changePassword')->name('change.password');
        Route::post('/admin/update/password', 'updatePassword')->name('admin.update.password');
    });

    // home slider
    // Route::controller(HomeSliderController::class)->prefix('admin')->as('admin.')->group(function () {
    //     Route::get('/home/slider', 'homeSlider')->name('home.slider');
    // })->middleware(['auth', 'verified']);
    // Route::controller(HomeSliderController::class)->group(function () {
    //     Route::get('/home/slider/edit', 'homeSliderEdit')->name('home.slider.edit');
    //     Route::post('/home/slider/update/{id}', 'homeSliderUpdate')->name('home.slider.update');
    // });

    // Supplier
    Route::resource('suppliers', SupplierController::class);
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/suppliers/delete/{supplier}', 'delete')->name('suppliers.delete');
        Route::get('/suppliers/active/{supplier}', 'active')->name('suppliers.active');
        Route::get('/suppliers/inactive/{supplier}', 'inactive')->name('suppliers.inactive');
    });

    // Customer
    Route::resource('customers', CustomerController::class);
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customers/delete/{customer}', 'delete')->name('customers.delete');
        Route::get('/customers/active/{customer}', 'active')->name('customers.active');
        Route::get('/customers/inactive/{customer}', 'inactive')->name('customers.inactive');
        Route::get('/customer/credit', 'creditCustomer')->name('customer.credit');
        Route::get('/customer/credit/pdf', 'creditCustomerPdf')->name('customer.credit.pdf');
        Route::get('/customer/invoice/edit/{invoice_id}', 'customerInvoiceEdit')->name('customer.invoice.edit');
        Route::post('/customer/invoice/update/{invoice_id}', 'customerInvoiceUpdate')->name('customer.invoice.update');
        Route::get('/customer/invoice/details/{invoice_id}', 'customerInvoiceDetails')->name('customer.invoice.details');
        Route::get('/customer/paid', 'paidCustomer')->name('customer.paid');
        Route::get('/customer/paid/pdf', 'paidCustomerPdf')->name('customer.paid.pdf');
        Route::get('/customer/wise/report', 'customerWiseReport')->name('customer.wise.report');
        Route::get('/customer/wise/credit/pdf', 'customerWiseCreditPdf')->name('customer.wise.credit.pdf');
        Route::get('/customer/wise/paid/pdf', 'customerWisePaidPdf')->name('customer.wise.paid.pdf');
    });

    // Unit
    Route::resource('units', UnitController::class);
    Route::controller(UnitController::class)->group(function () {
        Route::get('/units/delete/{unit}', 'delete')->name('units.delete');
        Route::get('/units/active/{unit}', 'active')->name('units.active');
        Route::get('/units/inactive/{unit}', 'inactive')->name('units.inactive');
    });

    // Cateogry
    Route::resource('categories', CategoryController::class);
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories/delete/{category}', 'delete')->name('categories.delete');
        Route::get('/categories/active/{category}', 'active')->name('categories.active');
        Route::get('/categories/inactive/{category}', 'inactive')->name('categories.inactive');
    });

    // Product
    Route::resource('products', ProductController::class);
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products/delete/{product}', 'delete')->name('products.delete');
        Route::get('/products/active/{product}', 'active')->name('products.active');
        Route::get('/products/inactive/{product}', 'inactive')->name('products.inactive');
    });

    // Purchase
    Route::resource('purchases', PurchaseController::class);
    Route::controller(PurchaseController::class)->group(function () {
        Route::get('/purchases/delete/{purchase}', 'delete')->name('purchases.delete');
        Route::get('/purchase/pending', 'pendingPurchase')->name('purchases.pending');
        Route::get('/purchase/approve/{purchase}', 'approvePurchase')->name('purchases.appove');
        Route::get('/purchase/daily/report', 'dailyPurchaseReport')->name('purchases.daily.report');
        Route::get('/purchase/daily/pdf', 'dailyPurchasePdf')->name('purchases.daily.pdf');
    });

    // Invoice
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/invoices/all', 'index')->name('invoices.index');
        Route::get('/invoices/create', 'create')->name('invoices.create');
        Route::post('/invoices/store', 'store')->name('invoices.store');
        Route::get('/invoices/delete/{invoice}', 'delete')->name('invoices.delete');
        Route::get('/invoices/pending/list', 'invoicePendingList')->name('invoices.pending.list');
        Route::get('/invoices/approve/{invoice}', 'invoiceApprove')->name('invoices.approve');
        Route::post('/invoices/approval/store/{invoice}', 'invoiceApprovalStore')->name('invoices.approval.store');
        Route::get('/invoices/print/list', 'invoicePrintList')->name('invoices.print.list');
        Route::get('/invoices/print/{invoice}', 'invoicePrint')->name('invoices.print');
        Route::get('/invoices/daily/report', 'invoiceDailyReport')->name('invoices.daily.report');
        Route::get('/invoices/daily/pdf', 'invoiceDailyPdf')->name('invoices.daily.pdf');
    });

    // Stock
    Route::controller(StockController::class)->group(function () {
        Route::get('/stock/report', 'stockReport')->name('stock.report');
        Route::get('/stock/report/pdf', 'stockReportPdf')->name('stock.report.pdf');
        Route::get('/stock/supplier/product/wise', 'stockSupplierProductWise')->name('stock.supplier.product.wise');
        Route::get('/stock/supplier/wise/pdf', 'stockSupplierWisePdf')->name('stock.supplier.wise.pdf');
        Route::get('/stock/product/wise/pdf', 'stockProductWisePdf')->name('stock.product.wise.pdf');
    });

    // For Ajax 
    Route::controller(DefaultController::class)->group(function () {
        Route::post('/get/category', 'getCategory')->name('get-category');
        Route::post('/get/catwise/product', 'getCatwiseProduct')->name('get-catewise-product');
        Route::post('/get/product', 'getProduct')->name('get-product');
        Route::post('/get/product/stock', 'getProductStock')->name('get-product-stock');
    });

});
