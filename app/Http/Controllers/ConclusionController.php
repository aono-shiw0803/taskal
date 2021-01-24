<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Matter;
use App\User;
use Carbon\Carbon;
use Yasumi\Yasumi;

class ConclusionController extends Controller
{
  public function index(Request $request, User $user){
    $posts = Post::orderBy('start_date', 'asc')->get();
    $matters = Matter::orderBy('rank', 'asc')->get();
    $users = User::all();
    $start_date = $request->start_date ?? Carbon::today()->format('Y-m-d');
    $end_date = $request->end_date ?? Carbon::today()->addDay(30)->format('Y-m-d');
    $today = Carbon::today()->format('Y年m月d日');
    $today2 = Carbon::today()->format('Y-m-d');
    $date = $date ?? Carbon::today();
    $date = is_string($date) ? Carbon::parse($date) : $date;
    $holidays = Yasumi::create('Japan', $date->year);
    $weeks = [0 => '日', 1 => '月', 2 => '火', 3 => '水', 4 => '木', 5 => '金', 6 => '土'];
    return view('conclusions.index', ['weeks'=>$weeks, 'today'=>$today, 'today2'=>$today2, 'holidays'=>$holidays, 'start_date'=>$start_date, 'end_date'=>$end_date, 'posts'=>$posts, 'matters'=>$matters, 'users'=>$users, 'user'=>$user]);
  }

  public function export_conclution(Request $request){
    $response = new StreamedResponse(function() use ($request){
      $stream = fopen('php://output', 'w');
      stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');
      fputcsv($stream, ['営業担当', '納品日','企業名/サイト名','種別','納品数','担当者']);
      // User::where('name', 'LIKE', '%')->chunk(1000, function($results) use ($stream){
      Post::chunk(1000, function($results) use ($stream){
        foreach($results as $result){
          if($result->delivery_date != null && $result->status == 1){
            fputcsv($stream, [$result->salestaff,$result->delivery_date,$result->matter,$result->type,"'".$result->delivery_number,$result->windowstaff]);
          }
        }
      });
      fclose($stream);
    });
    $response->headers->set('Content-Type', 'application/octet-stream');
    $response->headers->set('Content-Disposition', 'attachment; filename="ConclutionList.csv"');
    return $response;
  }

  public function delete_post(Request $request){
    $validatedData = $request->validate([
      'ids' => 'array|required'
    ]);
    Post::destroy($request->ids);
    session()->flash('flash_message', '削除が完了しました！');
    return redirect('/conclusions');
  }
}
