<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
     <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
     <META HTTP-EQUIV="EXPIRES" CONTENT="0">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Party Needs Management System</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}"/>
    <!--<link href="/css/app.css" rel="stylesheet">-->

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top navi">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        PNMS
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav hidden-md hidden-lg">
                      @if (Auth::guest())
                          &nbsp;
                      @else
                          <li><a href="{{ url('/home') }}">Dashboard</a></li>
                          <li class="dropdown">
                              <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-expanded="false">
                                  Maintenance <span class="caret"></span>
                              </a>

                              <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/customer') }}">Customer</a></li>
                                <li><a href="{{ url('/food') }}">Food</a></li>
                                <li><a href="{{ url('/foodCategory') }}">Food</a></li>
                                <li><a href="{{ url('/equipment') }}">Equipment</a></li>
                                <li><a href="{{ url('/equipmentTypes') }}">Equipment Type</a></li>
                                <li><a href="{{ url('/staff') }}">Staff</a></li>
                                <li><a href="{{ url('/package') }}">Package</a></li>
                                <li><a href="{{ url('/eventType') }}">Event Type</a></li>
                                <li><a href="{{ url('/motif') }}">Motif</a></li>
                                <li><a href="{{ url('/menu') }}">Menu</a></li>
                              </ul>
                          </li>
                      @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @if(Auth::guest())
          @yield('guest-content')
        @else
          <div class="container-fluid">
            <div class="row main">
              <div class="col-md-3 hidden-sm hidden-xs">
                <div class="sidebar">
                  <ul class="menu-list nav">
                    <li><a href="{{ url('/home') }}" id="dashboard">DASHBOARD</a></li>
                    <li>
                      <a href="#maintenance" data-toggle="collapse">MAINTENANCE</a>

                      <div id="maintenance" class="submenu collapse">
                        <ul class="nav">
                          <li><a href="{{ url('/customer') }}" id="customer">Customer</a></li>
                          <li><a href="{{ url('/food') }}" id="food">Food</a></li>
                          <li><a href="{{ url('/foodCategory') }}" id="foodCategory">Food Category</a></li>
                          <li><a href="{{ url('/equipment') }}" id="equipment">Equipment</a></li>
                          <li><a href="{{ url('/equipmentType') }}" id="equipmentType">Equipment Type</a></li>
                          <li><a href="{{ url('/staff') }}" id="staff">Staff</a></li>
                          <li><a href="{{ url('/package') }}" id="package">Package</a></li>
                          <li><a href="{{ url('/eventType') }}" id="eventType">Event Type</a></li>
                          <li><a href="{{ url('/motif') }}" id="eventType">Motif</a></li>
                          <li><a href="{{ url('/menu') }}" id="menu">Menu</a></li>
                        </ul>
                      </div>
                    </li>
                    <li><a href="#transaction" data-toggle="collapse" id="transMenu">TRANSACTION</a></li>
                  </ul>
                </div>
              </div>

              <div class=" col-sm-12 col-md-9 content" style="padding:25px;">
                @yield('error')
                @yield('content')
              </div>
            </div>
          </div>
        @endif

    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dataTables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.validate.js') }}" type="text/javascript"></script>
    @yield('js')
</body>
</html>
