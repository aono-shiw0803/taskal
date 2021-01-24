<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, inicial-scale=1.0">
  <meta name=”robots” content=”noindex”>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="/js/main.js"></script>
  <title>Taskal</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
  <div class="welcome">
    <div class="welcome-sub">
      <div class="welcome-logo">
        <img src="/storage/logo.png">
      </div>
      @yield('main')
    </div>
  </div>
</body>
</html>
