@extends('layouts.index')

@section('breadcrumbs')
  {{Breadcrumbs::render('posts-create')}}
@endsection

@section('main')
<div class="page-title">
  <p>新規タスク追加</p>
</div>
<div class="posts-must">
  <p id="must"><span>※</span>は入力必須項目です。</p>
</div>
<form method="post" action="{{url('/posts')}}" enctype="multipart/form-data">
  @csrf
  <table class="create-posts-table">
    <tbody>
      <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
      <input type="hidden" name="status" value=0>
      <tr>
        <th id="middle">案件名<span class="must">※</span></th>
        <td>
          <select autofocus id="small" name="matter">
            <option disabled selected value>選択してください</option>
            @foreach($matters as $matter)
            <option value="{{$matter->name}}" @if(old('matter', $matter->matter) == $matter->name) selected @endif>{{$matter->name}}</option>
            @endforeach
          </select>
          @if($errors->has('matter'))
          <span id="error">{{$errors->first('matter')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>タスク名<span class="must">※</span></th>
        <td>
          <input type="text" name="name" value="{{old('name')}}">
          @if($errors->has('name'))
          <span id="error">{{$errors->first('name')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>担当者<span class="must">※</span></th>
        <td>
          <select id="small" name="staff">
            <option disabled selected value>選択してください</option>
            @foreach($users as $user)
            <option value="{{$user->name}}">{{$user->name}}</option>
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
          <input type="date" name="start_date" value="{{old('start_date')}}">
          @if($errors->has('start_date'))
          <span id="error">{{$errors->first('start_date')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>完了日<span class="must">※</span></th>
        <td>
          <input type="date" name="end_date" value="{{old('end_date')}}">
          @if($errors->has('end_date'))
          <span id="error">{{$errors->first('end_date')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>重要チェック</th>
        <td>
          <input type="checkbox" name="important" value="1">&nbsp;&nbsp;&nbsp;<span id="important">※重要なタスクの場合はチェックを入れてください。</span>
          @if($errors->has('important'))
          <span id="error">{{$errors->first('important')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>備考</th>
        <td>
          <textarea id="textarea" name="content">{{old('content')}}</textarea>
          @if($errors->has('content'))
          <span id="error">{{$errors->first('content')}}</span>
          @endif
        </td>
      </tr>
    </tbody>
  </table>
  <div class="create-posts-btn-area">
    <ul>
      <li><input id="submit" type="submit" value="追加" onclick="return confirm('追加してもよろしいですか？')"></li>
    </ul>
  </div>
</form>
@endsection
