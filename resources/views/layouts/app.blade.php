<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title') - {{ config('app.name') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <!-- Token CSRF -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ config('app.url') }}resources/assets/app/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ config('app.url') }}resources/assets/app/bower_components/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" type="text/css" href="{{ config('app.url') }}resources/assets/app/bower_components/datatables.net/css/dataTables.bootstrap4.min.css"/>
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ config('app.url') }}resources/assets/app/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ config('app.url') }}resources/assets/app/css/AdminLTE.css">

  <link rel="stylesheet" href="{{ config('app.url') }}resources/assets/app/css/skins/skin-blue.min.css">
  
  <link rel="stylesheet" href="{{ config('app.url') }}resources/assets/app/css/app.css">

  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ config('app.url') }}resources/assets/app/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- jQuery 3 -->
  <script src="{{ config('app.url') }}resources/assets/app/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- ajouter Par Jackson -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue">
    <div id="wrapper">

        @include('layouts.partials._nav')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- /#page-wrapper -->
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    @yield('title')
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
              <b>Version beta</b> 0.0.3
          </div>
      </footer>

 </div>
 <!-- ./wrapper -->

 <!-- jQuery UI 1.11.4 -->
 <script src="{{ config('app.url') }}resources/assets/app/bower_components/jquery-ui/jquery-ui.min.js"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ config('app.url') }}resources/assets/app/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="{{ config('app.url') }}resources/assets/app/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="{{ config('app.url') }}resources/assets/app/js/scripts.js"></script>
</body>
</html>


