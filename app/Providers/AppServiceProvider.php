<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Unit;
use App\Observers\CategoryObserver;
use App\Observers\CustomerObserver;
use App\Observers\InvoiceObserver;
use App\Observers\ProductObserver;
use App\Observers\PurchaseObserver;
use App\Observers\SupplierObserver;
use App\Observers\UnitObserver;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        Supplier::observe(SupplierObserver::class);
        Customer::observe(CustomerObserver::class);
        Unit::observe(UnitObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        Purchase::observe(PurchaseObserver::class);
        Invoice::observe(InvoiceObserver::class);

        Facades\View::composer(['admin.partials.left_sidebar'], function (View $view) {
            $view->with('routeName', \Route::currentRouteName());
        });

    }
}
