<?php

namespace App\Providers;

use App\Actions\Auth\AuthorizeAction;
use App\Contracts\Auth\AuthorizeContract;
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
