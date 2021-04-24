<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/canvas.js') }}" defer></script>
  <script src="{{ asset('js/likes.js') }}" defer></script>
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <!-- Styles -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet"> </head>
<body>
  <div id="app">
    <header class="header">
      <nav class='headerNav navbar navbar-dark'>
      <a class='' href={{route( 'index')}}><img src="{{ asset('img\mainLogo.png') }}"></a>
        <div class="d-flex" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto"> </ul>
          <!-- Right Side Of Navbar -->
          <ul class="d-flex ml-auto">
            <!-- Authentication Links -->
            <a class="btn-outline-info btn mr-5 d-flex align-items-center px-5 headerNavPc" href="{{ route('illustration.new') }}"><i class="fas fa-plus mr-1 pr-1"></i>お絵描き投稿</a>
            @guest
            <li class="nav-item">
            <a class="btn-secondary btn" href="{{ route('login') }}">{{ __('ログイン / 新規登録') }}</a>
            </li>
            <!--
            @if (Route::has('register'))
            <li class="nav-item">
            <a class="btn-secondary btn" href="{{ route('register') }}">{{ __('新規登録') }}</a>
            </li>
            -->
            @endif @else
            <li class="nav-item dropdown  navBtn">
              <a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-secondary px-3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                {{ __('ログアウト') }}
              </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
              </div>
            </li> @endguest </ul>
        </div>
      </nav>
    </header>
    <div class="contentsArea">
      <section class="section"> @yield('content') </section>
    </div>
  </div>
  <footer class="footer">
    <div class="footer_inner"> <small class="footer_copy">このページは架空のサービスです。実在の団体・人物とは関係ありません。<br>Copyright© shinya kato</small> </div>
  </footer>
</body>
</html>