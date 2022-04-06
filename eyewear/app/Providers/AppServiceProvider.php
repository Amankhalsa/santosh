<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App\Admin_model\Admin;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('admin_data',Admin::where("admin_type","Admin")->first());
         Schema::defaultStringLength(191);
    }
}
