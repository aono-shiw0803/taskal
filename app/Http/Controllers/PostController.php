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
      $posts = Post::orderBy('start_date', 'asc')->get();
      $matters = Matter::orderBy('rank', 'asc')->get();
      $users = User::orderBy('rank', 'asc')->get();
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
      return view('posts.index', ['array'=>$array, 'weeks'=>$weeks, 'today'=>$today, 'today2'=>$today2, 'holidays'=>$holidays, 'start_date'=>$start_date, 'end_date'=>$end_date, 'posts'=>$posts, 'matters'=>$matters, 'users'=>$users, 'user'=>$user]);
    }

    public function show(Post $post, User $user){
      $matters = Matter::orderBy('rank', 'asc')->get();
      $users = User::orderBy('rank', 'asc')->get();
      $today = Carbon::today()->format('Y年m月d日');
      return view('posts.show', ['today'=>$today, 'post'=>$post, 'matters'=>$matters, 'users'=>$users, 'user'=>$user]);
    }

    public function create(){
      $matters = Matter::orderBy('rank', 'asc')->get();
      $users = User::orderBy('rank', 'asc')->get();
      $today = Carbon::today()->format('Y年m月d日');
      return view('posts.create', ['today'=>$today, 'matters'=>$matters, 'users'=>$users]);
    }

    public function store(PostRequest $request){
      $post = new Post();
      $post->name = $request->name;
      $post->matter = $request->matter;
      $post->staff = $request->staff;
      $post->start_date = $request->start_date;
      $post->end_date = $request->end_date;
      $post->content = $request->content;
      $post->status = $request->status;
      $post->important = $request->important;
      $post->user_id = $request->user_id;
      $post->save();
      session()->flash('flash_message', '登録が完了しました！');
      return redirect('posts/' . $post->id);
    }

    public function edit(Post $post, User $user){
      $matters = Matter::orderBy('rank', 'asc')->get();
      $users = User::orderBy('rank', 'asc')->get();
      $today = Carbon::today()->format('Y年m月d日');
      return view('posts.edit', ['today'=>$today, 'post'=>$post, 'matters'=>$matters, 'users'=>$users, 'user'=>$user]);
    }

    public function update(PostRequest $request, Post $post){
      $post->name = $request->name;
      $post->matter = $request->matter;
      $post->staff = $request->staff;
      $post->start_date = $request->start_date;
      $post->end_date = $request->end_date;
      $post->content = $request->content;
      $post->status = $request->status;
      $post->important = $request->important;
      $post->user_id = $request->user_id;
      $post->save();
      session()->flash('flash_message', '更新が完了しました！');
      return redirect('posts/' . $post->id);
    }

    public function delete(Request $request){
      Post::find($request->id)->delete();
      session()->flash('flash_message', '削除が完了しました！');
      return redirect('posts/');
    }
}
