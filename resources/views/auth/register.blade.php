@extends('layouts.app')

@section('main')
<div class="register-main">
  <div class="register-main-title">
    <p>新規メンバー登録</p>
  </div>
  <form method="POST" action="{{ route('register') }}">
    @csrf
    <input type="hidden" class="form-control @error('rank') is-invalid @enderror" name="rank" value="99" required autocomplete="rank">
    <ul>
      <li id="head-space" class="anime-1"><label for="name">ユーザー名（漢字）</label></li>
      <li class="anime-1">
        <input autofocus id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
        @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </li>
      <li id="head-space" class="anime-1"><label for="username">ユーザー名（英語）</label></li>
      <li class="anime-1">
        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
        @error('username')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </li>
      <li id="head-space" class="anime-3"><label for="email">メールアドレス</label></li>
      <li class="anime-4">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </li>
      <li id="head-space" class="anime-5"><label for="password">パスワード</label></li>
      <li class="anime-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </li>
      <li id="head-space" class="anime-7"><label for="password-confirm">パスワード（確認）</label></li>
      <li class="anime-8"><input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"></li>
      <li id="head-space" class="anime-9"><button type="submit" onclick"return confirm('登録してもよろしいですか？')">登録</button></li>
      <li id="head-space" class="anime-10"><a href="/users">メンバー一覧に戻る</a></li>
    </ul>
  </form>
</div>
@endsection
