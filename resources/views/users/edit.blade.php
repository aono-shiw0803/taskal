@extends('layouts.index')

@section('breadcrumbs')
  {{Breadcrumbs::render('users-edit', $user)}}
@endsection

@section('main')
<div class="page-title">
  <p>メンバー情報編集</p>
</div>
<div class="users-must">
  <p id="must"><span>※</span>は入力必須項目です。</p>
</div>
<form method="post" action="{{url('/users', $user->id)}}" enctype="multipart/form-data">
  @csrf
  @method('PATCH')
  <table class="edit-users-table">
    <tbody>
      <tr>
        <th>アイコン</th>
        <td>
          <input type="file" name="icon" value="{{old('icon', $user->icon)}}">
          @if($errors->has('icon'))
          <span id="error">{{$errors->first('icon')}}</span>
          @endif
          @isset($filename)
          <img src="{{asset('storage/public' . $user->icon)}}">
          @endisset
        </td>
      </tr>
      <tr>
        <th>名前<span class="must">※</span></th>
        <td>
          <input id="semi-middle" type="text" name="name" value="{{old('name', $user->name)}}">
          @if($errors->has('name'))
          <span id="error">{{$errors->first('name')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>ログインユーザー名<span class="must">※</span></th>
        <td>
          <input id="semi-middle" type="text" name="username" value="{{old('username', $user->username)}}">
          @if($errors->has('username'))
          <span id="error">{{$errors->first('username')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>メールアドレス<span class="must">※</span></th>
        <td>
          <input id="middle" type="text" name="email" value="{{old('email', $user->email)}}">
          @if($errors->has('email'))
          <span id="error">{{$errors->first('email')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>年齢</th>
        <td>
          <input type="text" inputmode="numeric" pattern="\d*" name="age" value="{{old('age', $user->age)}}" placeholder="0">
          @if($errors->has('age'))
            <span id="error">{{$errors->first('age')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>性別</th>
        <td>
          <select name="gender">
            @foreach(config('const.genders') as $gender)
              <option value="{{$gender}}" @if(old('gender', $user->gender) == $gender) selected @endif>{{$gender}}</option>
            @endforeach
          </select>
          @if($errors->has('gender'))
            <span id="error">{{$errors->first('gender')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>雇用形態</th>
        <td>
          <select name="employ">
            @foreach(config('const.employees') as $employ)
              <option value="{{$employ}}" @if(old('employ', $user->employ) == $employ) selected @endif>{{$employ}}</option>
            @endforeach
          </select>
          @if($errors->has('employ'))
            <span id="error">{{$errors->first('employ')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>表示順</th>
        <td>
          <input type="text" inputmode="numeric" pattern="\d*" name="rank" value="{{old('rank', $user->rank)}}">
          @if($errors->has('rank'))
          <span id="error">{{$errors->first('rank')}}</span>
          @endif
        </td>
      </tr>
    </tbody>
  </table>
  <div class="edit-users-btn-area">
    <ul>
      <li><input id="submit" type="submit" value="更新" onclick="return confirm('更新してもよろしいですか？')"></li>
    </ul>
  </div>
</form>
@endsection
