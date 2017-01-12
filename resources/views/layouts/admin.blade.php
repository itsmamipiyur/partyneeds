<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Party Needs System - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"/>
    <!--<link rel="stylesheet" href="{{ asset('css/app.css') }}"/>-->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}"/>
  </head>
  <body>
    @if(!Session::has('user_id'))
      <script type="text/javascript">
        window.location.href = '/';
      </script>
    @endif

    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="{{ url('/') }}">PNMS</a>
          <a class="pull-right" href="{{ url('/logout') }}">Logout</a>
        </div>
      </div>
    </nav>

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-2 sidebar">
        <h3>Maintenance</h3>
        <hr>
        <ul class="nav nav-sidebar">
          <li><a href="{{ url('/customer') }}">Customer</a></li>
          <li><a href="{{ url('/food') }}">Food</a></li>
          <li><a href="{{ url('/equipment') }}">Equipment</a></li>
          <li><a href="{{ url('/staff') }}">Staff</a></li>
        </ul>
      </div>

      <div class="col-lg-10 content" style="padding:25px;">
        @yield('error')
        @yield('content')
      </div>
    </div>
  </div>

  <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/bootstrap.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/dataTables.bootstrap.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/jquery.validate.js') }}" type="text/javascript"></script>
  @yield('js')

  </body>
</html>
