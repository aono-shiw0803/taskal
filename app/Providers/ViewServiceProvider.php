<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\UsersComposer;
use App\Http\View\Composers\PostsComposer;
use App\Http\View\Composers\MattersComposer;
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
      // 全てのViewにMattersComposerの内容を表示
      View::composer(
          '*', UsersComposer::class
      );
      View::composer(
          '*', PostsComposer::class
      );
      View::composer(
          '*', MattersComposer::class
      );
    }
}
