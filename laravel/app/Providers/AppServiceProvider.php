<?php

namespace App\Providers;

use App\ProductService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //给一个别名，然后调用闭包， new 一个 class
        $this->app->singleton('product', function () {
            return new ProductService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
