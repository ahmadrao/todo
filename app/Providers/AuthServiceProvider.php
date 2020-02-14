<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Todo;
use App\Policies\TodoPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Todo::class => TodoPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Gate::define('update-todo', function ($user, $todo) {
            return $user->id === $todo->user_id;
        });

        \Gate::define('delete-todo', function ($user, $todo) {
            return $user->id === $todo->user_id;
        });
    }
}
