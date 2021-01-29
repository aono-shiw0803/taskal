<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\UsersComposer;
use App\Http\View\Composers\PostsComposer;
use App\Http\View\Composers\MattersComposer;
use App\Http\View\Composers\DateComposer;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
          '*', UsersComposer::class
        );
        View::composer(
          '*', PostsComposer::class
        );
        View::composer(
          '*', MattersComposer::class
        );
        View::composer(
          '*', DateComposer::class
        );
    }
}
