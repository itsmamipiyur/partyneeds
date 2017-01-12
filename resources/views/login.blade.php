<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Party Needs Management System - Login</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}"/>
  </head>
  <body>
    <div class="container">
        <div class="card card-container">
          <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
          <p id="profile-name" class="profile-name-card">Party Needs Management System</p>

          {!! Form::open(['url' => '/', 'class' => 'form-signin']) !!}
              {{ Form::text('inputUsername', '', ['class' => 'form-control', 'placeholder' => 'Username', 'required' => 'true', 'autofocus', 'true']) }}
              {{ Form::password('inputPassword', '', ['class' => 'form-control', 'placeholder' => 'Password', 'required' => 'true']) }}
              {{ Form::button('Sign In', ['class' => 'btn btn-lg btn-primary btn-block btn-signin', 'type' => 'submit']) }}
          {!! Form::close() !!}
      </div><!-- /card-container -->
  </div><!-- /container -->
  </body>
</html>
