@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('conclusions') }}
@endsection

@section('main')
<div class="page-title">
  <p>完了タスク一覧</p>
</div>
<div id="conclusions-btn">
  <ul>
    <li><a href="{{route('export.conclution')}}" id="csv">CSV出力</a></li>
    <li><a href="{{url('/posts/create')}}" id="new">タスク追加</a></li>
    <li><a href="{{url('/posts')}}" id="pass">未完了タスク一覧</a></li>
  </ul>
</div>

<div class="index-conclusions">
  <table class="index-conclusions-table">
    <tbody>
      <tr>
        <th>詳細</th>
        <th>案件名</th>
        <th>タスク名</th>
        <th>担当者</th>
        <th>開始日</th>
        <th>完了日</th>
      </tr>
      @forelse($posts as $post)
      @if($post->status == 1)
      <tr>
        <td><a href="{{url('/posts', $post->id)}}" id="detail">詳細</a></td>
        <td class="matter">{{$post->matter}}</td>
        <td class="task">{{$post->name}}</td>
        <td class="staff">
          <p>
            @if($user->icon == null)
              <img src="/storage/no-icon.png"><span>{{$post->staff}}</span>
            @else
              <img src="/storage/{{$user->icon}}"><span>{{$post->staff}}</span>
            @endif
          </p>
        </td>
        <td>{{$post->start_date}}</td>
        <td>{{$post->end_date}}</td>
      </tr>
      @endif
      @empty
      <tr>
        <td colspan="6" id="null">完了タスクはありません</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
