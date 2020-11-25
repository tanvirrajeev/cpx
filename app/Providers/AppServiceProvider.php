<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){

        // Gate::define('finance-only', function($user){
        //     if($user->role == 'Branch Finance Staff'){
        //         return true;
        //     }
        //     return false;
        // });


    }
}
