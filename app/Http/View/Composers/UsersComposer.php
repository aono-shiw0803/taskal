<?php

namespace App\Http\View\Composers;

use App\User; //対象のModel
use Illuminate\View\View; //Viewに表示させるための決まり

class UsersComposer //Providerに渡すアクションを書く
{
    public function compose(View $view) // Viewはbladeに表示させる受け渡しクラス（決まり）
    {
      // viewの中に一緒に変数を定義する
        $view->with('users', User::orderBy('rank', 'asc')->get()); // 通常Controllerに書いていたロジックがここに書かれている。
    }
}
