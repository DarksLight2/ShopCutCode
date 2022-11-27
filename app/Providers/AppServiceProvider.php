<?php

namespace App\Providers;

use App\Actions\Auth\AuthorizeAction;
use App\Actions\Auth\RegisterUserAction;
use App\Contracts\Auth\AuthorizeContract;
use App\Contracts\Auth\RegisterUserContract;
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
        $this->app->bind(AuthorizeContract::class, AuthorizeAction::class);
        $this->app->bind(RegisterUserContract::class, RegisterUserAction::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
