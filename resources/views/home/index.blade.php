<title>Módulos disponibles</title>

@extends('layouts.'.$layout)
@section('content')


<div class="">

  <div class="clearfix"></div>



  <div class="row">
      <div class="flash-message" id="messages">
      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))

        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
      @endforeach
    </div> <!-- end .flash-message -->
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Módulos de acceso</h2>

          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="row">
            <a href="{{route('profile',['profile' => 'administrador'])}}">
              <div class="col-md-4">
                <div class="thumbnail">
                  <div class="image view">
                    <div class="img-circle image_profile">
                      <center>
                        <img src="{{asset('images/profile/add.png')}}" alt="..." style="width: 100px; display: block; height: 100px;">

                      </center>
                    </div>
                    <div class="clearfix">

                    </div>
                  </div>
                  <div class="caption">
                    <p><center>Administradores de Sistema</center></p>
                    <div class="text-center">
                      <a href="{{route('profile',['profile' => 'administrador'])}}" class="btn btn-primary btn-xs">Soy administrador!</a>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            <a href="{{route('profile',['profile' => 'docente'])}}">
              <div class="col-md-4">
                <div class="thumbnail">
                  <div class="image view">
                    <div class="img-circle image_profile">
                      <center>
                        <img src="{{asset('images/profile/add.png')}}" alt="..." style="width: 100px; display: block; height: 100px;">

                      </center>
                    </div>
                    <div class="clearfix">

                    </div>
                  </div>
                  <div class="caption">
                    <p><center>Docentes</center></p>
                    <div class="text-center">
                      <a href="{{route('profile',['profile' => 'docente'])}}" class="btn btn-primary btn-xs">Soy docente!</a>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            <a href="{{route('profile',['profile' => 'estudiante'])}}">
              <div class="col-md-4">
                <div class="thumbnail">
                  <div class="image view">
                    <div class="img-circle image_profile">
                      <center>
                        <img src="{{asset('images/profile/add.png')}}" alt="..." style="width: 100px; display: block; height: 100px;">

                      </center>
                    </div>
                    <div class="clearfix">

                    </div>
                  </div>
                  <div class="caption">
                    <p><center>Estudiantes</center></p>
                    <div class="text-center">
                      <a href="{{route('profile',['profile' => 'estudiante'])}}" class="btn btn-primary btn-xs">Soy estudiante!</a>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>


<script src="{{asset('js/app/tdocumento/index.js')}}" charset="utf-8"></script>
@stop
