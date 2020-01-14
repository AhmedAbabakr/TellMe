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
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Admins' => 'App\Policies\AdminsUserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('roleview', 'App\Policies\TypesPolicy@view');
        Gate::define('rolecreate', 'App\Policies\TypesPolicy@create');
        Gate::define('roleupdate', 'App\Policies\TypesPolicy@update');
        Gate::define('roledelete', 'App\Policies\TypesPolicy@delete');
        //
    }
}
