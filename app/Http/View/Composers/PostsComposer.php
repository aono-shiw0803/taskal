<?php

namespace App\Http\View\Composers;

use App\Post;
use Illuminate\View\View;

class PostsComposer
{
  public function compose(View $view){
    $view->with('posts', Post::orderBy('start_date', 'asc')->get());
  }
}
