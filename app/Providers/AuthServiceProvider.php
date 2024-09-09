<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin;
use App\Models\Company;

class AuthServiceProvider extends ServiceProvider
{
    //

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('super_admin', function($user){
            return $user->role === 1;
        });
    
        Gate::define('admincompany', function($user){
            return $user->role > 1 && $user->role <= 5;
        });
    }
}