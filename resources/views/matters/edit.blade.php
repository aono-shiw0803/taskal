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
  @method('PATCH')
  <table class="edit-posts-table">
    <tbody>
      <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
      <tr>
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
      <tr>
        <th>タスク名<span class="must">※</span></th>
        <td>
          <select name="task" value="{{old('task', $post->task)}}">
            @foreach($tasks as $task)
            <option value="{{$task->title}}" @if(old('task', $post->task) == $task->title) selected @endif>{{$task->title}}</option>
            @endforeach
          </select>
          @if($errors->has('task'))
          <span id="error">{{$errors->first('task')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>作業者<span class="must">※</span></th>
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
