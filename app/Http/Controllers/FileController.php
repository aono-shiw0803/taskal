<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Matter;
use App\File;
use Carbon\Carbon;
use Yasumi\Yasumi;
use App\Http\Requests\FileRequest;

class FileController extends Controller
{
  public function index(){
    $files = File::orderBy('created_at', 'desc')->get();
    $matters = Matter::orderBy('rank', 'asc')->get();
    $users = User::orderBy('rank', 'asc')->get();
    $today = Carbon::today()->format('Y年m月d日');
    return view('files.index', ['today'=>$today, 'files'=>$files, 'matters'=>$matters, 'users'=>$users]);
  }

  public function create(){
    $matters = Matter::orderBy('rank', 'asc')->get();
    $users = User::orderBy('rank', 'asc')->get();
    $today = Carbon::today()->format('Y年m月d日');
    return view('files.create', ['today'=>$today, 'matters'=>$matters, 'users'=>$users]);
  }

  public function store(FileRequest $request){
    $file = new File();
    $file->file = $request->file;
    $file->matter = $request->matter;
    $file->type = $request->type;
    $file->content = $request->content;
    $file->user_id = $request->user_id;
    $request->file('file')->storeAs('public','upload_file.'.$request->type);
    $file->save();
    session()->flash('flash_message', 'アップロードが完了しました！');
    return redirect('/files');
  }

  public function delete(Request $request){
    File::find($request->id)->delete();
    session()->flash('flash_message', '削除が完了しました！');
    return redirect('/files');
  }
}
