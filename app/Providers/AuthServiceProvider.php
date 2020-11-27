<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('finance-only', function($user){
            if($user->role->name == 'Dhaka Finance Staff'){
                return true;
            }
            return false;
        });

        Gate::define('branch-admin-only', function($user){
            if($user->role->name == 'Branch Admin'){
                return true;
            }
            return false;
        });

    }
}
