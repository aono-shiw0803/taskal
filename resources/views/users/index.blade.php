@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('users') }}
@endsection

@section('main')
<div class="page-title">
  <p>メンバー一覧</p>
</div>
@if(Auth::user()->id == 1)
<div class="index-users-btn-area">
  <ul>
    <li><a href="{{url('/register')}}" id="new-user">メンバー追加</a></li>
  </ul>
</div>
@endif
<table class="index-users-table">
  <tbody>
    <tr>
      <th>ID</th>
      <th>アイコン</th>
      <th>名前</th>
      <th>編集</th>
      <th>削除</th>
    </tr>
    @forelse($users as $user)
    <tr>
      @if($user->id == 1)
        <td id="admin">{{$user->id}}<br><span>（管理者）</span></td>
      @else
        <td>{{$user->id}}</td>
      @endif
      @if($user->icon == null)
        <td><img src="/storage/no-icon.png"></td>
      @else
        <td><img src="/storage/{{$user->icon}}"></td>
      @endif
      <td><a href="{{url('users/' . $user->id)}}" class="link">{{$user->name}}</a></td>
      <td>
        @if(Auth::user()->id == 1)
        <a href="{{action('UserController@edit', $user)}}" id="detail">編集</a>
        @else
        <p>－</p>
        @endif
      </td>
      <td>
        @if(Auth::user()->id == 1)
        <form method="post" action="/users/delete/{{$user->id}}">
          @csrf
          <input id="delete" type="submit" value="削除" onclick="return confirm('本当に削除してもよろしいですか？※関連する全てのデータも削除されます。')">
        </form>
        @else
        <p>－</p>
        @endif
      </td>
    </tr>
    @empty
    <tr>
      <td colspan="5" id="null">現在メンバーがいません</td>
    </tr>
    @endforelse
  </tbody>
</table>
@endsection
