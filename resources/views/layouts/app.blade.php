<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- responsive meta tag -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	{{-- <!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

	<!-- Javascript -->
	<script type="text/javascript" src={{ asset("bootstrap/js/jquery-3.4.1.min.js") }}"></script>
	<script type="text/javascript" src={{ asset("bootstrap/js/jquery-3.4.1.slim.min.js") }}"></script>
	<script type="text/javascript" src={{ asset("bootstrap/js/popper.min.js") }}"></script>
    <script type="text/javascript" src={{ asset("bootstrap/js/bootstrap.min.js") }}"></script> --}}
    
     <!-- Scripts bawaan ini -->

    <script src="{{ asset('bootstrap/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" ></script>
     

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href={{asset("bootstrap/css/jquery.dataTables.min.css")}}>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{__('Home')}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if (!Auth::check()) 
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('サインアップ') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('userlist') }}">{{ __('ユーザー') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('productlist') }}">{{ __('商品') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span class="caret">{{ __('マイページ') }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('mypage') }}">{{ __("マイアカウント") }}</a>
                                    <a class="dropdown-item" href="{{ route('transactionlist') }}">{{ __("取引") }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


    {{-- footer --}}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <hr style="width: 1000px; margin-bottom: 10px">
                    <p> &copy 2020 </p>
                </div>
            </div>
        </div>
      </section>
   
</body>
</html>
