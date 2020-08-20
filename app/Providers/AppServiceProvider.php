<?php

namespace App\Providers;

use App\View\Components\Categories;
use App\View\Components\Languages;
use App\View\Components\NewsArchive;
use App\View\Components\Sources;
use Illuminate\Support\Facades\Blade;
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
        //
    }

    public function boot()
    {
        Blade::component('news-archive', NewsArchive::class);
        Blade::component('languages', Languages::class);
        Blade::component('sources', Sources::class);
        Blade::component('categories', Categories::class);
    }
}
