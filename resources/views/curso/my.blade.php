<title>Mis Cursos</title>

@extends('layouts.'.$layout)
@section('content')
  <div class="">

    <!-- <div class="row"> -->
        <div class="flash-message" id="messages">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))

          <p class="alert alert-{{ $msg }} alert-dissmisable">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
      </div> <!-- end .flash-message -->


      <div class="col-md-12 col-sm-12 col-xs-12">


          @forelse($data as $data)

          <div class="x_panel">
            <div class="x_title">
              @if ($doce == true)
                Cátedra: {{ $data->ac_asig()->first()->asi_desc}} - {{$data->gn_naca()->first()->nac_desc}}
              @else
                <h2>Mis Cursos</h2>
              @endif
              <div class="clearfix"></div>
            </div>

            <div class="x_content">
              @forelse($data->ac_curses()->get() as $subdata)
              <a href="{{route('actindex',['cur_cont'=>$subdata->cur_cont])}}">
                <div class="col-md-12">
                  <h3>{{$subdata->cur_desc}}</h3>
                  <div class="col-md-4 col-xs-12 col-sm-12">
                    Fechas:
                    <p><ul>
                      <li> Inicio: {{$subdata->cur_fini}}</li>
                      <li> Fin: {{$subdata->cur_fina}}</li>
                    </ul></p>
                  </div>

                  <div class="col-md-4 col-xs-12 col-sm-12">
                    Objetivos:
                    <p><ul>
                      <li> General: {{$subdata->cur_obge}}</li>
                      <li> Específicos: <p> {!! nl2br($subdata->cur_obes) !!}</p></li>
                    </ul></p>
                  </div>

                  <div class="col-md-4 col-xs-12 col-sm-12">
                    Actividades:
                    @if ($subdata->cu_actis() != null)
                      <p> {{$subdata->cu_actis()->count()}}</p>
                    @else
                      <p>0</p>
                    @endif
                  </div>

                  <a href="{{route('actindex',['cur_cont'=>$subdata->cur_cont])}}" class="btn btn-primary pull-right"> Abrir curso</a>
                </div>
              </a>
              <div class="clearfix"></div>
              <div class="ln_solid">

              </div>
              @empty
                <center> <p> No se encontraron cursos asociados a tu usuario</p></center>
              @endforelse
            </div>
          </div>

          @empty
            <center> <p> No se encontraron cursos asociadas a tu usuario</p></center>
          @endforelse



      </div>



      <!-- </div> -->

      </div>


      <script src="{{asset('js/app/curso/index.js')}}" charset="utf-8"></script>
@stop
