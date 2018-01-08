<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"></script>
</head>
<body>
    <div id="app" class="container">
        <nav class="navbar navbar-light static-top navbar-toggleable-md bg-faded">
            <div class="container">

              <!-- Branding Image -->
              <a class="navbar-brand" href="{{ url('/') }}">
                  Larattel
              </a>


                <div class="collapse navbar-default" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                          <form action="/messages">
                            <div class="input-group">
                              <input type="text" name="query" class="form-control" placeholder="Buscar..." required>
                              <span class="input-group-btn">
                                <button class="btn btn-outline-success">Buscar</button>
                              </span>
                            </div>
                          </form>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-ite"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            <li class="nav-ite"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu">

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>

                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>

            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->


  <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
