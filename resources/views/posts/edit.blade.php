@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('posts-edit', $post) }}
@endsection

@section('main')
<div class="page-title">
  <p>タスク編集</p>
</div>
<div class="posts-must">
  <p id="must"><span>※</span>は入力必須項目です。</p>
</div>
<form method="post" action="{{url('/posts', $post->id)}}">
  @csrf
  @method('PUT')
  <table class="edit-posts-table">
    <tbody>
      <tr>
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <th>案件名<span class="must">※</span></th>
        <td>
          <select autofocus name="matter">
            @foreach($matters as $matter)
            <option value="{{$matter->name}}" @if(old('matter', $post->matter) == $matter->name) selected @endif>{{$matter->name}}</option>
            @endforeach
          </select>
          @if($errors->has('matter'))
          <span id="error">{{$errors->first('matter')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>タスク<span class="must">※</span></th>
        <td>
          <input type="text" name="name" value="{{old('name', $post->name)}}">
          @if($errors->has('name'))
          <span id="error">{{$errors->first('name')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>担当者<span class="must">※</span></th>
        <td>
          <select name="staff">
            @foreach($users as $user)
            <option value="{{$user->name}}" @if(old('user', $post->staff) == $user->name) selected @endif>{{$user->name}}</option>
            @endforeach
          </select>
          @if($errors->has('staff'))
          <span id="error">{{$errors->first('staff')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>開始日<span class="must">※</span></th>
        <td>
          <input type="date" name="start_date" value="{{old('start_date', $post->start_date)}}">
          @if($errors->has('start_date'))
          <span id="error">{{$errors->first('start_date')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>完了日<span class="must">※</span></th>
        <td>
          <input type="date" name="end_date" value="{{old('end_date', $post->end_date)}}">
          @if($errors->has('end_date'))
          <span id="error">{{$errors->first('end_date')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>タスク状況<span class="must">※</span></th>
        <td>
          <select name="status">
            <option value=0 @if(old('status', $post->status) == 0) selected @endif>未完了</option>
            <option value=1 @if(old('status', $post->status) == 1) selected @endif>完了</option>
          </select>
        </td>
      </tr>
      <tr>
        <th>重要チェック</th>
        <td>
          <input type="checkbox" name="important" value=1 @if(old('important', $post->important) == 1) checked @endif>&nbsp;&nbsp;&nbsp;<span id="important">※重要なタスクの場合はチェックを入れてください。</span>
          @if($errors->has('important'))
          <span id="error">{{$errors->first('important')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>備考</th>
        <td>
          <textarea id="textarea" name="content">{{old('content', $post->content)}}</textarea>
          @if($errors->has('content'))
          <span id="error">{{$errors->first('content')}}</span>
          @endif
        </td>
      </tr>
    </tbody>
  </table>
  <div class="edit-posts-btn-area">
    <ul>
      <li><input id="submit" type="submit" value="更新" onclick="return confirm('更新してもよろしいですか？')"></li>
    </ul>
  </div>
</form>
@endsection
