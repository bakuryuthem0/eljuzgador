<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/font-awesome/css/font-awesome.min.css')}}">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
    {{ HTML::style("frameworks/bootstrap/css/bootstrap.min.css") }}
    <!-- Font Awesome -->
    <!-- Ionicons -->
    <!-- Theme style -->
    {{ HTML::style("templates/admin/dist/css/AdminLTE.min.css") }}
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    {{ HTML::style("templates/admin/dist/css/skins/_all-skins.min.css") }}
    <!-- Date Picker -->
    {{ HTML::style("templates/admin/plugins/datepicker/datepicker3.css") }}
    <!-- bootstrap wysihtml5 - text editor -->
    {{ HTML::style("templates/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") }}

    {{ HTML::style('templates/admin/custom-admin.css') }}

    {{ HTML::script("frameworks/jquery.min.js") }}
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    
    <input type="hidden" class="baseUrl" value="{{ URL::to('/') }}">
    <div class="wrapper">
      @if(Auth::check())
      <header class="main-header">
        <!-- Logo -->
        <a href="{{ URL::to('administrador') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>LT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{ asset('templates/admin/dist/img/'.Auth::user()->avatar) }}" class="user-image" alt="User Image">
                  <span class="hidden-xs">{{ Auth::user()->name.' '.Auth::user()->lastname }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{ asset('templates/admin/dist/img/'.Auth::user()->avatar) }}" class="img-circle" alt="User Image">
                    <p>
                      {{ Auth::user()->name.' '.Auth::user()->lastname }}
                      <small>Miembro desde {{ date('d-m-Y',strtotime(Auth::user()->created_at)) }}</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="{{ URL::to('administrador/usuario/perfil') }}" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ URL::to('administrador/logout') }}" class="btn btn-default btn-flat">Cerrar Sesión</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
     
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ asset('templates/admin/dist/img/'.Auth::user()->avatar) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>{{ Auth::user()->name.' '.Auth::user()->lastname }}</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active ">
              <a href="{{ URL::to('administrador') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pencil"></i>
                <span>Noticias</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ URL::to('administrador/noticia/nueva') }}"><i class="fa fa-circle-o"></i> Nueva Noticia</a></li>
                <li><a href="{{ URL::to('administrador/noticias/ver-noticias') }}"><i class="fa fa-circle-o"></i> Ver Noticias </a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-list"></i>
                <span>Categorías</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ URL::to('administrador/categoria/nueva') }}"><i class="fa fa-circle-o"></i> Nueva Categoría</a></li>
                <li><a href="{{ URL::to('administrador/categorias/ver-categorias') }}"><i class="fa fa-circle-o"></i> Ver Categorías</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Usuarios</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ URL::to('administrador/usuario/nuevo') }}"><i class="fa fa-circle-o"></i> Nuevo Usuario</a></li>
                <li><a href="{{ URL::to('administrador/ver-usuarios') }}"><i class="fa fa-circle-o"></i> Ver Usuarios</a></li>
              </ul>
            </li>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
       @endif
      <!-- Content Wrapper. Contains page content -->
      
        
        @yield('content')
      <footer class="main-footer @if(!Auth::check()) no-auth @endif">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
      </footer>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->

    <!-- Bootstrap 3.3.5 -->
    {{ HTML::script("frameworks/bootstrap/js/bootstrap.min.js") }}
    <!-- datepicker -->
    {{ HTML::script("templates/admin/plugins/datepicker/bootstrap-datepicker.js") }}
    <!-- Bootstrap WYSIHTML5 -->
    {{ HTML::script("templates/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}
    <!-- AdminLTE App -->
    {{ HTML::script("templates/admin/dist/js/app.min.js") }}
    {{ HTML::script('js/functions.js') }}
    {{ HTML::script('templates/admin/custom-admin.js') }}
    @yield('postscript')
  </body>
</html>
