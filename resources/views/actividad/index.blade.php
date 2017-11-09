<title>Creación de Actividades - Curso {{$master->cur_desc }}</title>

@extends('layouts.'.$layout)
@section('content')
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Curso: {{ $master->cur_desc }}</h3>
      </div>

    </div>

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
            <h2>Información General</h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-4 col-sm-12 col-xs-12">

                <label for=""> Nombre del Curso</label>
                <p class="">{{ $master->cur_desc }}</p>

                <label for=""> Inicio Curso</label>
                <p class="">{{ $master->cur_fini }}</p>
                <label for=""> Fin Curso</label>
                <p class="">{{ $master->cur_fina }}</p>
            </div>

            <div class="col-md-4 col-sm-12 col-xs-12">

                <label for="">Objetivos</label>
                <li><label for="">Objetivo General</label>
                  <ul>
                    <p class="">{{ $master->cur_obge }}</p>
                  </ul>
                </li>

                <li><label for="">Objetivos Específicos</label>
                  <ul>
                    <p class="">{!! nl2br($master->cur_obes) !!}</p>
                  </ul>
                </li>

            </div>

            <div class="col-md-4 col-sm-12 col-xs-12">

                <label for=""> Estudiantes Matriculados</label>
                <p class="">{{ $master->cu_matris->count() }}</p>
                @if ($edit == true)
                  <a href="{{ route('matindex',['cur_cont' => $master->cur_cont]) }}" class="btn btn-success"><i class="fa fa-plus"></i> Matricular Nuevo Estudiante</a>
                @endif
            </div>

          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Actividades</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              @if ($edit == true)
                <a href="{{ route('actnew',['cur_cont' => $master->cur_cont]) }}">
                  <div class="col-md-55">
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
                        <p><center>Nueva actividad</center></p>
                        <div class="text-center">
                          <a href="{{ route('actnew',['cur_cont' => $master->cur_cont]) }}" class="btn btn-primary btn-xs">Click aquí!</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              @endif
              @forelse($data as $data)
              <a href="{{ route('actshow',['cur_cont' => $master->cur_cont,'act_cont' => $data->act_cont]) }}">
                <div class="col-md-55 col-sm-8">
                  <div class="thumbnail">
                    <div class="image view">
                      <div class="">
                        <center>
                          @if($data->act_img != null and $data->act_img != "")
                            <img src="{{asset('images/act_img/'.$data->act_img)}}" alt="..." style="width: 100%; display: block;">

                          @else
                            <img src="{{asset('images/act_img/no_image.png')}}" alt="..." style="width: 160px; display: block; height: 100px;" >

                          @endif

                        </center>
                      </div>
                      <div class="clearfix">

                      </div>
                    </div>
                    <div class="caption">
                      <p><center>{{ $data->act_titu }}</center></p>
                      <div class="text-center">
                        <a href="{{ route('actshow',['cur_cont' => $master->cur_cont,'act_cont' => $data->act_cont]) }}" class="btn btn-default btn-xs"><i class="fa fa-search"></i></a>
                        @if ($edit == true)
                          <a href="{{ route('actedit',['cur_cont' => $master->cur_cont,'act_cont' => $data->act_cont]) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                        @endif
                      </div>

                    </div>
                  </div>
                </div>
              </a>
              @empty

              @endforelse
            </div>
          </div>
        </div>

      </div>



      </div>

      </div>


      <script src="{{asset('js/app/actividad/index.js')}}" charset="utf-8"></script>
@stop
