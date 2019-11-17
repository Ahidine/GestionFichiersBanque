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

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="index.html" class="logo"><b>BAN<span>QUE</span></b></a>
      <!--logo end-->

      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li> <a class="logout fa fa-btn fa-sign-out" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form></li>

        </ul>

      </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.html"><img src="{{asset('template/img/User-icon.png')}}" class="img-circle" width="100"></a></p>
          <h5 class="centered">{!! auth::user()->name !!}</h5>


          <li class="sub-menu trait">
            <a href="{{url('/Mon_agence')}}">
              <i class="fa fa-desktop"></i>
              <span>Mon Agence</span>
              </a>
          </li>
           <li class="sub-menu trait">
            <a href="{{ url('/Show_Agents')}}">
              <i class="fa fa-desktop"></i>
              <span>Gestions des Agents</span>
              </a>
          </li>
           <li class="sub-menu trait">
            <a href="{{ url('/Les_Dossiers')}}">
              <i class="fa fa-desktop"></i>
              <span>Gestions des Dossiers</span>
              </a>
          </li>
          <li class=" trait">
            <a href="{{ url('/Setting')}}">
              <i class="fa fa-cogs"></i>
              <span>Configuration</span>
              </a>
          </li>
          <li class="sub-menu deco trait">
            <a class="logout " href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-btn fa-sign-out"></i>
              <span>Deconnecter</span>
              </a>

          </li>

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">

        <!-- /container -->

       @yield('content')
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center" >
        <p>
          &copy; Copyrights <strong>HIDINE</strong>. All Rights Reserved
        </p>

        <a href="profile.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src=" {{asset('template/lib/jquery/jquery.min.js')}}  "></script>
  <script src=" {{asset('template/lib/bootstrap/js/bootstrap.min.js')}} "></script>
  <script class="include" type="text/javascript" src=" {{asset('template/lib/jquery.dcjqaccordion.2.7.js')}}  "></script>
  <script src=" {{asset('template/lib/jquery.scrollTo.min.js')}} "></script>
  <script src=" {{ asset('template/lib/jquery.nicescroll.js')}} " type="text/javascript"></script>
  <!--common script for all pages-->
  <script src=" {{asset('template/lib/common-scripts.js')}} "></script>
  <!--script for this page-->
  <!-- MAP SCRIPT - ALL CONFIGURATION IS PLACED HERE - VIEW OUR DOCUMENTATION FOR FURTHER INFORMATION -->






</body>

</html>
