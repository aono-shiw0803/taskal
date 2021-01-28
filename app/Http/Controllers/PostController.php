<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Matter;
use Carbon\Carbon;
use Yasumi\Yasumi;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Request $request, User $user){
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
        // $start = $end = $dayCount = null;
        if ($current->year == $startCarbon->year && $current->month == $startCarbon->month) {
          $start = $startCarbon;
          $end = $startCarbon->copy()->endOfMonth();
          $dayCount = $end->diffInDays($start);
        } elseif ($current->year == $startCarbon->year && $current->month == $startCarbon->month) {
        // } else if ($current->year == $endCarbon->year && $current->month == $endCarbon->month) {
          $start = $endCarbon->copy()->startOfMonth();
          $end = $endCarbon;
          $dayCount = $end->diffInDays($start);
        } else {
          $start = $current->copy()->startOfMonth();
          $end = $current->copy()->endOfMonth();
        }
        $dayCount = $end->diffInDays($start) + 1;
        return compact('start', 'end', 'dayCount');
      });
      return view('posts.index', ['array'=>$array, 'weeks'=>$weeks, 'today'=>$today, 'today2'=>$today2, 'holidays'=>$holidays, 'start_date'=>$start_date, 'end_date'=>$end_date, 'user'=>$user]);
    }

    public function show(Post $post, User $user){
      $today = Carbon::today()->format('Y年m月d日');
      return view('posts.show', ['today'=>$today, 'post'=>$post, 'user'=>$user]);
    }

    public function create(){
      $today = Carbon::today()->format('Y年m月d日');
      return view('posts.create', ['today'=>$today]);
    }

    public function store(PostRequest $request){
      Post::create($request->validated());
      session()->flash('flash_message', '登録が完了しました！');
      return redirect('posts/' . $post->id);
    }

    public function edit(Post $post, User $user){
      $today = Carbon::today()->format('Y年m月d日');
      return view('posts.edit', ['today'=>$today, 'post'=>$post, 'users'=>$users, 'user'=>$user]);
    }

    public function update(PostRequest $request, Post $post){
      $post->create($request->validated());
      session()->flash('flash_message', '更新が完了しました！');
      return redirect('posts/' . $post->id);
    }

    public function delete(Request $request){
      Post::find($request->id)->delete();
      session()->flash('flash_message', '削除が完了しました！');
      return redirect('posts/');
    }
}
