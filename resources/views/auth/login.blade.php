<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="HIDINE">
  <meta name="keyword" content="">
  <title>Banque</title>

  <!-- Favicons -->
  <link href="template/img/favicon.png" rel="icon">
  <link rel="shortcut icon"  href="template/img/arroser.jpg">

  <!-- Bootstrap core CSS -->
  <link href=" {{asset('template/lib/bootstrap/css/bootstrap.min.css')}} " rel="stylesheet">
  <!--external css-->
  <link href=" {{ asset('template/lib/font-awesome/css/font-awesome.css') }} " rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href=" {{ asset('template/css/style.css')}} " rel="stylesheet">
  <link href=" {{asset('template/css/style-responsive.css')}} " rel="stylesheet">
  <link rel="stylesheet" type="text/css" href=" {{ asset('template/css/style2.css')}} ">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>


  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
    @yield('head-section')
</head>

<body onload="lancer()">
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">

      <!--logo start-->
      <a href="index.html" class="logo"><b>BAN<span>QUE</span></b></a>
      <!--logo end-->


    </header>





<div class="container" >
    <div class="row" style="margin-top: 20vh;">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style=" border: 2px #4ECDC4 solid ; border-radius: 20px;">
                <div class="panel-heading" style="background-color: #4ECDC4;border: 2px #4ECDC4 solid ; border-top-right-radius: 15px;border-top-left-radius: 15px;">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
