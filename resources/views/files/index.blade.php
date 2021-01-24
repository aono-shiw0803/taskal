@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('files') }}
@endsection

@section('main')
<div class="page-title">
  <p>ファイル一覧</p>
</div>

<div class="index-files-btn-area">
  <ul>
    <li><a href="{{url('/files/create')}}" id="new">新規ファイルアップロード</a></li>
  </ul>
</div>

<table class="index-files-table">
  <tbody>
    <tr>
      <th>ファイル</th>
      <th>該当案件</th>
      <th>アップロード日時</th>
      <th>備考</th>
      <th>削除</th>
    </tr>
    @forelse($files as $file)
    <tr>
      <td>
        @if($file->type == 'xlsx')
        <a href="/storage/upload_file.xlsx" id="download">ダウンロード</a>
        @elseif($file->type == 'docx')
        <a href="/storage/upload_file.docx" id="download">ダウンロード</a>
        @elseif($file->type == 'pptx')
        <a href="/storage/upload_file.pptx" id="download">ダウンロード</a>
        @elseif($file->type == 'pdf')
        <a href="/storage/upload_file.pdf" id="download">ダウンロード</a>
        @elseif($file->type == 'jpg')
        <a href="/storage/upload_file.jpg" id="download">画像を確認</a>
        @elseif($file->type == 'png')
        <a href="/storage/upload_file.png" id="download">画像を確認</a>
        @else
        <a href="/storage/upload_file.txt" id="download">テキストを確認</a>
        @endif
      </td>
      <td class="matter">{{$file->matter}}</td>
      <td>{{$file->created_at}}</td>
      <td><p>{{$file->content}}</p></td>
      <!-- 備考は改行を反映させるために<p>タグで囲っている -->
      <td>
        @if(Auth::user()->id == 1 || Auth::user()->id == 4)
        <form method="post" action="/files/delete/{{$file->id}}">
          @csrf
          <input id="delete" type="submit" value="削除" onclick="return confirm('本当に削除してもよろしいですか？')">
        </form>
        @else
        <p>－</p>
        @endif
      </td>
    </tr>
    @empty
    <tr>
      <td  colspan="5" id="null">現在アップロードされているファイルはありません。</td>
    </tr>
    @endforelse
  </tbody>
</table>
@endsection
