<?php

namespace App\Http\View\Composers;

use App\Matter;
use Illuminate\View\View;

class MattersComposer
{
    public function compose(View $view){
      // viewの中に一緒に変数を定義する
      $view->with('matters', Matter::orderBy('rank', 'asc')->get());
    }
}
