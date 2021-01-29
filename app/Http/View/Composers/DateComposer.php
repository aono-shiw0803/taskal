<?php

namespace App\Http\View\Composers;

use Carbon\Carbon;
use Illuminate\View\View;

class DateComposer
{
  public function compose(View $view){
    $view->with('today', Carbon::today()->format('Y年m月d日'));
  }
}
