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
        <link href="{{asset('vendors/pnotify/dist/pnotify.css')}}" rel="stylesheet">
        <link href="{{asset('vendors/pnotify/dist/pnotify.buttons.css')}}" rel="stylesheet">
        <link href="{{asset('vendors/pnotify/dist/pnotify.nonblock.css')}}" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet">


        <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
       <!-- Bootstrap -->
       <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>

       <script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
       <script src="{{asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
       <script src="{{asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
       <script src="{{asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
       <script src="{{asset('vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
       <script src="{{asset('vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
       <script src="{{asset('vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
       <script src="{{asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
       <script src="{{asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
       <script src="{{asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
       <script src="{{asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
       <script src="{{asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>

       <script src="{{asset('vendors/pnotify/dist/pnotify.js')}}"></script>
       <script src="{{asset('vendors/pnotify/dist/pnotify.buttons.js')}}"></script>
       <script src="{{asset('vendors/pnotify/dist/pnotify.nonblock.js')}}"></script>
       <script src="{{asset('vendors/select2/dist/js/select2.full.js')}}"></script>

   </head>
   <body class="nav-md">
     <div class="container body">
       <div class="main_container">
         <div class="col-md-3 left_col">
           <div class="left_col scroll-view">
             <div class="navbar nav_title" style="border: 0;">
               <a href="index.html" class="site_title"><i class="fa fa-graduation-cap"></i> <span>Circuteach</span></a>
             </div>
             <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="{{asset('images/profile/teacher.png')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2>{{$user->ter_pnom}} {{$user->ter_pape}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
             <div class="menu_section">
               <h3>General</h3>
               <ul class="nav side-menu">
                 <li><a><i class="fa fa-home"></i> Inicio <span class="fa fa-chevron-down"></span></a>
                   <ul class="nav child_menu">
                     <li><a href="{{route('mediaprincipal')}}"> Todos los videos</a></li>
                     <li><a href="{{route('artmedia')}}"> Videos de Artículos</a></li>
                     <li><a href="{{route('actmedia')}}"> Videos de Actividades</a></li>
                     <li><a href="{{route('entmedia')}}"> Videos de Entregas de Trabajo</a></li>
                   </ul>
                 </li>

               </ul>

              </div>

              <div class="menu_section">
                <h3>Docente</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-desktop"></i> Aula Virtual <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('curindex')}}">Gestionar Cursos</a></li>
                      <li><a href="{{route('curmy')}}">Mis cursos</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-video-camera"></i> Artículos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('artindex')}}"> Gestión de Artículos</a></li>
                    </ul>
                  </li>
                </ul>
               </div>



           </div>

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{route('logout')}}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->


           </div>
         </div>

         <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>

              </div>




              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('images/profile/teacher.png')}}" alt="">
                    {{ Session::get("user") }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">

                    <li><a href="javascript:;">Ayuda</a></li>
                    <li><a href="{{route('logout')}}"><i class="fa fa-sign-out pull-right"></i> Salir</a></li>
                  </ul>
                </li>



              </ul>
              <div class="clearfix"></div>

            </nav>
          </div>
          <div class="nav nav-navbar col-md-6 col-md-offset-3">
              <div class="nav nav-justified">
                {{Form::open(array('url' => route('searchmedia'),'role'=>'search'))}}
                    <div class="input-group">

                        <div class="input-group-btn">
                            <button type="button" class="btn btn-search btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-search"></span>
                                <span class="label-icon">Busca en Todo</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-left" role="menu">
                               <li>
                                    <a onclick="cambiar('principal')">
                                        <span class="glyphicon glyphicon-search"></span>
                                        <span class="label-icon">Buscar en Todo</span>
                                    </a>
                                </li>
                                <li>
                                    <a onclick="cambiar('articulo')">
                                    <span class="fa fa-newspaper-o"></span>
                                    <span class="label-icon">Buscar por Artículos</span>
                                    </a>
                                </li>
                                <li>
                                    <a onclick="cambiar('actividad')">
                                    <span class="glyphicon glyphicon-book"></span>
                                    <span class="label-icon">Buscar por Actividades</span>
                                    </a>
                                </li>
                                <li>
                                    <a onclick="cambiar('entrega')">
                                    <span class="fa fa-pencil-square-o"></span>
                                    <span class="label-icon">Buscar por Entregas</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <input type="text" name="search" id="search" placeholder="Buscar..." autocomplete="off" class="form-control">

                        <div class="input-group-btn">
                            <button type="button" class="btn btn-search btn-default">
                            <span class="fa fa-search"></span> Buscar
                            </button>
                        </div>
                    </div>

            </div>
            <div class="clearfix"></div>

              <select class="" name="env" id="env" style="display: none;">
                <option value="principal">Todo</option>
                <option value="articulo">Artículos</option>
                <option value="actividad">Actividades</option>
                <option value="entrega">Entregas</option>
              </select>

            {{Form::close()}}

          </div>
        </div>

        <!-- page content -->
       <div class="right_col" role="main">


          @yield('content')

       </div>
       <!-- /page content -->

       <!-- footer content -->
       <footer>
         <div class="pull-right">
           Nombre de app <a href="https://colorlib.com">Link app</a>
         </div>
         <div class="clearfix"></div>
       </footer>
       <!-- /footer content -->
     </div>
   </div>



      <!-- FastClick -->
      <script src="{{asset('vendors/fastclick/lib/fastclick.js')}}"></script>
      <!-- NProgress -->
      <script src="{{asset('vendors/nprogress/nprogress.js')}}"></script>

      <!-- Custom Theme Scripts -->
      <script src="{{asset('build/js/custom.min.js')}}"></script>
      <script type="text/javascript">

        $(function(){

         $(".input-group-btn .dropdown-menu li a").click(function(){

             var selText = $(this).html();
            $(this).parents('.input-group-btn').find('.btn-search').html(selText);

          });

        });

        function cambiar(data) {
          $("#env").val(data);
        }
      </script>
    </body>
</html>
