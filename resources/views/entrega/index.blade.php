<title>Entregas - Actividad {{$master->act_titu }}</title>

@extends('layouts.'.$layout)
@section('content')
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Actividad: {{ $master->act_titu }}</h3>
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

                <label for=""> Nombre de la Actividad</label>
                <p class="">{{ $master->act_titu }}</p>
                <label for=""> Disponibilidad de Actividad</label>

                <li>
                  <label for="">Desde</label>
                  <ul>
                    <p class="">{{ $master->act_fini }}</p>

                  </ul>
                </li>
                <li>
                  <label for=""> Hasta</label>
                  <ul>
                    <p class="">{{ $master->act_fina }}</p>

                  </ul>
                </li>


            </div>


            <div class="col-md-4 col-sm-12 col-xs-12">

                <label for=""> Entregas esperadas</label>
                <p class="">{{ $master->ac_curs()->first()->cu_matris->count() }}</p>

                <label for=""> Entregas existentes</label>
                @if ($master->cu_entrs != null)
                  <p class="">{{ $master->cu_entrs->count() }}</p>
                @else
                  <p> 0 </p>
                @endif
            </div>

          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Total de Entregas hasta el momento</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              @if ($edit == true)
              <a href="{{ route('entnew',['act_cont' => $master->act_cont]) }}">
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
                      <p><center>Nueva entrega</center></p>
                      <div class="text-center">
                        <a href="{{ route('entnew',['act_cont' => $master->act_cont]) }}" class="btn btn-primary btn-xs">Click aquí!</a>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              @endif


              <div class="clearfix">

              </div>
              <div class="ln_solid">

              </div>

              @forelse($data as $data)
              <a href="{{ route('entshow',['act_cont' => $master->act_cont,'ent_cont' => $data->ent_cont]) }}">
                <div class="col-md-55 col-sm-8">
                  <div class="thumbnail">
                    <div class="image view">
                      <div class="">
                        <center>
                          @if($data->ent_img != null and $data->ent_img != "")
                            <img src="{{asset('images/ent_img/'.$data->ent_img)}}" alt="..." style="width: 100%; display: block;">

                          @else
                            <img src="{{asset('images/ent_img/no_image.png')}}" alt="..." style="width: 160px; display: block; height: 100px;" >

                          @endif

                        </center>
                      </div>
                      <div class="clearfix">

                      </div>
                    </div>
                    <div class="caption">
                      <p><center>{{ $data->ent_titu }}</center></p>
                      <div class="text-center">
                        <a href="{{ route('entshow',['act_cont'=>$master->act_cont,'ent_cont'=>$data->ent_cont]) }}" class="btn btn-default btn-xs"><i class="fa fa-search"></i></a>
                        @if ($edit == true)
                          <a href="{{ route('entedit',['act_cont'=>$master->act_cont,'ent_cont'=>$data->ent_cont]) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                        @endif
                      </div>

                    </div>
                  </div>
                </div>
              </a>
              @empty
                <center>
                <p><i class="fa fa-folder"></i> No existen registros</p>
                </center>
              @endforelse
            </div>
          </div>
        </div>

        <a onclick="window.history.back();" class="btn btn-default"> Volver Atrás</a>
      </div>



      </div>

      </div>


      <script src="{{asset('js/app/actividad/index.js')}}" charset="utf-8"></script>
@stop
