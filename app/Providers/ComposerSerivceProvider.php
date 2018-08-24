<?php

namespace App\Providers;

use App\Http\ViewComposers\MenuComposer;
use Illuminate\Support\ServiceProvider;

class ComposerSerivceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.menu', MenuComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
