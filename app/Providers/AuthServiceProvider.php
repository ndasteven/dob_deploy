<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\eleve;
use App\Models\User;
use App\Policies\StudentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        eleve::class=>StudentPolicy::class,
        User::class => \App\Policies\AdminPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
