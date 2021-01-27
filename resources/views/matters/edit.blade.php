@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('matters-edit', $matter) }}
@endsection

@section('main')
<div class="page-title">
  <p>案件編集</p>
</div>
<div class="matters-must">
  <p id="must"><span>※</span>は入力必須項目です。</p>
</div>
<form method="post" action="{{url('/matters', $matter->id)}}">
  @csrf
  @method('PUT')
  <table class="edit-matters-table">
    <tbody>
      <input type="hidden" name="user_id" value="{{old('user_id', $matter->user_id)}}">
      <tr>
        <th id="middle">案件名<span class="must">※（20文字以内）</span></th>
        <td>
          <input autofocus id="large" type="text" name="name" placeholder="例）方針案作成" value="{{old('name', $matter->name)}}">
          @if($errors->has('name'))
          <br><span id="error">{{$errors->first('name')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>表示順</th>
        <td>
          <input type="text" inputmode="numeric" pattern="\d*" name="rank" value="{{old('rank', $matter->rank)}}">
          @if($errors->has('rank'))
          <span id="error">{{$errors->first('rank')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>備考</th>
        <td>
          <textarea id="textarea" name="content">{{old('content', $matter->content)}}</textarea>
          @if($errors->has('content'))
          <br><span id="error">{{$errors->first('content')}}</span>
          @endif
        </td>
      </tr>
    </tbody>
  </table>
  <div class="edit-matters-btn-area">
    <ul>
      <li><input id="submit" type="submit" value="更新" onclick="return confirm('更新してもよろしいですか？')"></li>
    </ul>
  </div>
</form>
@endsection
