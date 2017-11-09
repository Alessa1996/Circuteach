<title>Matricular estudiante - Curso {{$master->cur_desc }}</title>

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
                
            </div>


          </div>
        </div>
      </div>

      <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Listado de estudiantes disponibles</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <table id="datatable2" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Nº Documento</th>
                    <th>Estudiante</th>
                    <th>Nivel Académico</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>

      </div>

      <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Estudiantes Matriculados</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <table id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Nº Documento</th>
                    <th>Estudiante</th>
                    <th>Nivel Académico</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>

      </div>

      <a href="{{route('actindex',['cur_cont' => $master->cur_cont])}}" class="btn btn-default"> Volver atrás</a>





      </div>

      </div>
        <script>
            var urllist = "{{route('matlistmat',['cur_cont'=>$master->cur_cont])}}";
            var table1 = $("#datatable").DataTable({
              ajax: urllist
            });
            var urllist2 = "{{route('matlistest',['cur_cont'=>$master->cur_cont])}}";
            var table2 = $("#datatable2").DataTable({
              ajax: urllist2
            });
            var _token = "{{ csrf_token() }}";
        </script>


      <script src="{{asset('js/app/matricula/index.js')}}" charset="utf-8"></script>
@stop
