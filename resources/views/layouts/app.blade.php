<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @livewireStyles
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="http://www.ucss.edu.pe" target="_blank">
          <img class="navbar-brand" src="{{asset('images/logo-ucss.png')}}" ></img>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
          {{-- Left Side Of Navbar --}}
            @auth
              <li class="nav-item">
                {{ \Session::get('facultad') . ' - ' . \Session::get('sede') }}
              </li>            
            @endif
          </ul>
        </div>
        <ul class="navbar-nav ml-auto">
          {{-- Right Side Of Navbar --}}
            @if( config('app.debug') )
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                  {{ __('Login') }}
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">
                  {{ __('Register') }}
                </a>
              </li>
            @endif
            {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> --}}
            @auth
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }}
                  <span class="caret">
                  </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('access.panel') }}">Accesos</a>
              </li>
            {{-- @else --}}
            @endif
            {{-- </div>  --}}
        </ul>
      </div>
    </nav>

    @include('layouts.partials.errors')
    <main class="py-4">

      @yield('content')
    </main>
    <!-- Footer -->
    @include('layouts.partials.footer')
  </div>
  @yield('script')
  @livewireScripts
</body>
</html>
