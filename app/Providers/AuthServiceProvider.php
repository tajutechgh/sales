<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('products.products','App\Policies\ProductPolicy@products');

        Gate::define('products.pos','App\Policies\ProductPolicy@pos');

        Gate::define('products.sales','App\Policies\ProductPolicy@sales');

        Gate::define('products.report','App\Policies\ProductPolicy@report');

        Gate::define('products.expenses','App\Policies\ProductPolicy@expenses');

        Gate::define('products.settings','App\Policies\ProductPolicy@settings');
    }
}
