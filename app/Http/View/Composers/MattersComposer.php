<?php

namespace App\Http\View\Composers;

use App\Matter;
use Illuminate\View\View;

class MattersComposer
{
  public function compose(View $view){
    $view->with('matters', Matter::orderBy('rank', 'asc')->get());
  }
}
