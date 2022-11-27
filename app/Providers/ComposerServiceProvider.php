<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{

    public function register()
    {
    }


    public function boot()
    {
        view()->composer('*', function ($view) {
            $view->with(
                'menu_category',
                Cache::rememberForever('menu_category', function () {
                    return Category::query()->get();
                })
            );
        });
    }
}