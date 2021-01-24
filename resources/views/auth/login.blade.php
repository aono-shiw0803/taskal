@extends('layouts.app')

@section('main')
<div class="login-main">
  <form method="POST" action="{{ route('login') }}">
    @csrf
    <ul>
      <li id="head-space" class="anime-1"><label for="username">ユーザー名</label></li>
      <li class="anime-2">
        <input autofocus id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" required autocomplete="current-username">
        @error('username')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </li>
      <li id="head-space" class="anime-3"><label for="password">パスワード</label></li>
      <li class="anime-4">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </li>
      <!-- <li id="head-space">
        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label for="remember" id="remember">次回から自動入力</label>
      </li> -->
      <li id="head-space" class="anime-5"><button type="submit">ログイン</button></li>
      <!-- <li id="head-space" class="anime-6">
        @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}">パスワードを忘れてしまった場合はこちら</a>
        @endif
      </li> -->
    </ul>
  </form>
</div>
@endsection
