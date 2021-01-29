<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Matter;
use Carbon\Carbon;
use Yasumi\Yasumi;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
  public function index(User $user){
    $today = Carbon::today()->format('Y年m月d日');
    return view('users.index', ['today'=>$today, 'user'=>$user]);
  }

  public function show(Request $request, User $user){
    $user = User::find($user->id);
    $posts = Post::where('staff', $user->name)->orderBy('start_date', 'asc')->paginate(10);
    $start_date = $request->start_date ?? Carbon::today()->format('Y-m-d');
    $end_date = $request->end_date ?? Carbon::today()->addDays(30)->format('Y-m-d');
    $today = Carbon::today()->format('Y年m月d日');
    $today2 = Carbon::today()->format('Y-m-d');
    $date = $date ?? Carbon::today();
    $date = is_string($date) ? Carbon::parse($date) : $date;
    $holidays = Yasumi::create('Japan', $date->year);
    $weeks = [0 => '日', 1 => '月', 2 => '火', 3 => '水', 4 => '木', 5 => '金', 6 => '土'];
    $startCarbon = Carbon::parse($start_date);
    $endCarbon = Carbon::parse($end_date);
    $array = collect(range(0, $endCarbon->diffInMonths($startCarbon)))
    ->map(function($month) use ($startCarbon, $endCarbon) {
      $current = $startCarbon->copy()->addMonth($month);
      $start = $end = null;
      if ($current->year == $startCarbon->year && $current->month == $startCarbon->month) {
        $start = $startCarbon;
        $end = $startCarbon->copy()->endOfMonth();
      } else if ($current->year == $startCarbon->year && $current->month == $startCarbon->month) {
        $start = $endCarbon->copy()->startOfMonth();
        $end = $endCarbon;
      } else {
        $start = $current->copy()->startOfMonth();
        $end = $current->copy()->endOfMonth();
      }
      $dayCount = $end->diffInDays($start) + 1;
      return compact('start', 'end', 'dayCount');
    });
    return view('users.show', ['array'=>$array, 'weeks'=>$weeks, 'today'=>$today, 'today2'=>$today2, 'holidays'=>$holidays, 'user'=>$user, 'start_date'=>$start_date, 'end_date'=>$end_date, 'posts'=>$posts]);
  }

  public function edit(User $user){
    $today = Carbon::today()->format('Y年m月d日');
    return view('users.edit', ['today'=>$today, 'user'=>$user]);
  }

  public function update(UserRequest $request, User $user){
    $user->name = $request->name;
    $user->email = $request->email;
    $user->username = $request->username;
    $user->rank = $request->rank;
    $user->age = $request->age;
    $user->gender = $request->gender;
    $user->employ = $request->employ;
    if($user->icon = $request->icon){
      $path = $request->file('icon')->store('public');
      $user->icon = basename($path);
    }
    $user->save();
    session()->flash('flash_message', '個人情報を更新しました！');
    // return redirect('/users')->with('filename', basename($path));
    return redirect('/users');
  }

  public function delete(Request $request){
    User::find($request->id)->delete();
    session()->flash('flash_message', 'メンバーを削除しました！');
    return redirect('/users');
  }
}
