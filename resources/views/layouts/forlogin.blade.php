<html>
    <head>
      <title>Flat Admin V.2 - Free Bootstrap Admin Templates</title>
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">

        <link href="{{asset('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
        <!-- Datatables -->
        <link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('vendors/select2/dist/css/select2.css')}}" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet">


        <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
       <!-- Bootstrap -->
       <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>

       <script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
       <script src="{{asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
       <script src="{{asset('vendors/select2/dist/js/select2.full.js')}}"></script>

   </head>
   <body class="login">


          @yield('content')

    


      <!-- FastClick -->
      <script src="{{asset('vendors/fastclick/lib/fastclick.js')}}"></script>
      <!-- NProgress -->
      <script src="{{asset('vendors/nprogress/nprogress.js')}}"></script>

      <!-- Custom Theme Scripts -->
      <script src="{{asset('build/js/custom.min.js')}}"></script>
    </body>
</html>

