<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // Ambil semua role dari database
        $roles = Role::all();

        foreach ($roles as $role) {
            Gate::define($role->name, function ($user) use ($role) {
                return $user->roles->contains('name', $role->name);
            });
        }
    }
}
