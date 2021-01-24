<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, inicial-scale=1.0">
  <meta name=”robots” content=”noindex”>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <script src="/js/main.js"></script>
  <title>Taskal</title>
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
  @if(session('login_message'))
    <div class="login-bg">
    </div>
    <div class="login-message">
      <div class="login-message-main">
        <h1><span>{{$today}}</span>&nbsp;のタスク</h1>
        <table>
          <tbody>
            <tr>
              <th>案件名</th><th>タスク名</th><th>担当者</th>
            </tr>
            @php
              $posts = \App\Post::where('start_date', '<=', \Carbon\Carbon::today())->where('end_date', '>=', \Carbon\Carbon::today())->orderBy('start_date', 'asc')->get();
            @endphp
            @forelse($posts as $post)
            <tr>
              <td>{{$post->matter}}</td><td>{{$post->name}}</td><td>{{$post->staff}}</td>
            </tr>
            @empty
            <tr>
              <td id="null" colspan="3">タスクはありません。</td>
            </tr>
            @endforelse
          </tbody>
        </table>
        <input autofocus type="submit" value="close">
      </div>
    </div>
  @endif
  <header>
    <div class="header-logo">
      <a href="{{url('/posts')}}"><img src="/storage/logo.png"></a>
    </div>
    <div class="header-icon">
      @if(Auth::User()->icon == null)
        <a href="{{url('/users', Auth::User()->id)}}"><img src="/storage/no-icon.png"></a>
      @else
        <a href="{{url('/users', Auth::User()->id)}}"><img src="/storage/{{Auth::User()->icon}}"></a>
      @endif
    </div>
    <div class="header-btn">
      <ul>
        <li>{{$today}}</li>
        <li>
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('ログアウト') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
      </ul>
    </div>
  </header>
  @if(session('flash_message'))
    <div class="flash">
      <h2>{{session('flash_message')}}</h2>
    </div>
  @endif

  <main>
    <div class="left-side">
      <nav>
        <ul>
          <li><i id="close" class="fas fa-times"></i></li>
          @if(Auth::user()->id == 1 || Auth::user()->id == 4)
          <li id="nav-user">
            あなたは管理者です<span class="caret"></span>
          </li>
          @endif
          <li><p id="nav-title"><a href="{{url('/matters')}}">案件一覧</a></p>
            <ul>
              @foreach($matters as $matter)
                <li id="nav-link"><a href="{{url('/matters', $matter->id)}}">{{$matter->name}}</a></li>
              @endforeach
            </ul>
          </li>
          <li><p id="nav-title"><a href="{{url('/users')}}">メンバー一覧</a></p>
            <ul>
              @foreach($users as $user)
                <li id="nav-link">
                  <a class="users-icon" href="{{url('/users', $user->id)}}">
                    @if($user->icon == null)
                      <img src="/storage/no-icon.png"><p>{{$user->name}}</p>
                    @else
                      <img src="/storage/{{$user->icon}}"><p>{{$user->name}}</p>
                    @endif
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
          <li id="nav-file"><a href="{{url('/files')}}">ファイル一覧</a></li>
        </ul>
      </nav>
    </div>

    <div class="right-side">
      <div class="right-head">
        <ul>
          <li id="open-right"><i id="open" class="fas fa-chevron-circle-right"></i></li>
          <li><h2>@yield('breadcrumbs')</h2></li>
        </ul>
      </div>
      <div class="container">
        @yield('main')
      </div>
    </div>

    <footer>
      <p>©&nbsp;2021&nbsp;Taskal</p>
    </footer>
  </main>

</body>
</html>
