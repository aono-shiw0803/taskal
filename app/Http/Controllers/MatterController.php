<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Matter;
use Carbon\Carbon;
use Yasumi\Yasumi;
use App\Http\Requests\MatterRequest;

class MatterController extends Controller
{
  public function index(User $user){
    return view('matters.index', ['user'=>$user]);
  }

  public function show(Request $request, Matter $matter, User $user){
    $matter = Matter::find($matter->id);
    $posts = Post::where('matter', $matter->name)->orderBy('start_date', 'asc')->paginate(10);
    $start_date = $request->start_date ?? Carbon::today()->format('Y-m-d');
    $end_date = $request->end_date ?? Carbon::today()->addDays(30)->format('Y-m-d');
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
    return view('matters.show', ['array'=>$array, 'weeks'=>$weeks, 'today2'=>$today2, 'holidays'=>$holidays, 'matter'=>$matter, 'start_date'=>$start_date, 'end_date'=>$end_date, 'user'=>$user, 'posts'=>$posts]);
  }

  public function create(Matter $matter, User $user){
    return view('matters.create');
  }

  public function store(MatterRequest $request){
    Matter::create($request->validated());
    session()->flash('flash_message', '案件を追加しました！');
    return redirect('/matters');
  }

  public function edit(Matter $matter, User $user){
    return view('matters.edit', ['matter'=>$matter, 'user'=>$user]);
  }

  public function update(MatterRequest $request, Matter $matter){
    $matter->fill($request->validated())->save();
    session()->flash('flash_message', '案件を更新しました！');
    return redirect('/matters');
  }

  public function delete(Request $request){
    Matter::find($request->id)->delete();
    session()->flash('flash_message', '削除が完了しました！');
    return redirect('/matters');
  }
}
