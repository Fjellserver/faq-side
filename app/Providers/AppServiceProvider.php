<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        // Stricter password policy in production for new and reset passwords.
        Password::defaults(function () {
            return $this->app->isProduction()
                ? Password::min(12)->letters()->numbers()->uncompromised()
                : Password::min(8);
        });
    }
}
