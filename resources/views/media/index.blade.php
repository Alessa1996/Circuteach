<title>Todos Nuestros Videos</title>

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
          <h2>Videos - Artículos generales</h2>

          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="row">
            @forelse ($articulo as $data)
              <a href="{{ route('player',['env' => 'articulo','id' => sha1($data->art_cont)]) }}">
                <div class="col-md-55 col-sm-8">
                  <div class="thumbnail">
                    <div class="image view">
                      <div class="">
                        <center>
                          @if($data->art_img != null and $data->art_img != "")
                            <img src="{{asset('images/art_img/'.$data->art_img)}}" alt="..." style="width: 100%; display: block;">

                          @else
                            <img src="{{asset('images/art_img/no_image.png')}}" alt="..." style="width: 160px; display: block; height: 100px;" >

                          @endif

                        </center>
                      </div>
                      <div class="clearfix">

                      </div>
                    </div>
                    <div class="caption">
                      <p><center>{{ $data->art_titu }}</center></p>

                    </div>
                  </div>
                </div>
              </a>
            @empty
              <div class="text-center">
                <h2> No existen videos en nuestros registros</h2>
              </div>
            @endforelse
            <div class="clearfix"></div>
            <div class="ln_solid"></div>
              @if ($is_search == true)
              <a href="{{route('artmedia',['search' => $search])}}">
                <div class="btn-link">
                  <p class="text-center">
                    Ver todos...
                  </p>
                </div>
              </a>
              @else
                <a href="{{route('artmedia')}}">
                  <div class="btn-link">
                    <p class="text-center">
                      Ver todos...
                    </p>
                  </div>
                </a>
              @endif

          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Videos - Actividades docentes</h2>

          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="row">
            @forelse ($actividad as $data)
              <a href="{{ route('player',['id' => sha1($data->act_cont),'env' => 'actividad']) }}">
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

                    </div>
                  </div>
                </div>
              </a>
            @empty
              <div class="text-center">
                <h2> No existen videos en nuestros registros</h2>
              </div>
            @endforelse
            <div class="clearfix"></div>
            <div class="ln_solid"></div>

              @if ($is_search == true)
                <a href="{{route('actmedia',['search'=>$search])}}">
                  <div class="btn-link">
                    <p class="text-center">
                      Ver todos...
                    </p>
                  </div>
                </a>

              @else
                <a href="{{route('actmedia')}}">
                  <div class="btn-link">
                    <p class="text-center">
                      Ver todos...
                    </p>
                  </div>
                </a>
              @endif
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Videos - Entregas de estudiantes</h2>

          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="row">
            @forelse ($entrega as $data)
              <a href="{{ route('player',['id' => sha1($data->ent_cont), 'env' => 'entrega']) }}">
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

                    </div>
                  </div>
                </div>
              </a>
            @empty
              <div class="text-center">
                <h2> No existen videos en nuestros registros</h2>
              </div>
            @endforelse
            <div class="clearfix"></div>
            <div class="ln_solid"></div>
            @if ($is_search == true)
              <a href="{{route('entmedia',['search'=>$search])}}">
                <div class="btn-link">
                  <p class="text-center">
                    Ver todos...
                  </p>
                </div>
              </a>
            @else
              <a href="{{route('entmedia')}}">
                <div class="btn-link">
                  <p class="text-center">
                    Ver todos...
                  </p>
                </div>
              </a>
            @endif
          </div>
        </div>
      </div>
    </div>

  </div>

</div>


<script src="{{asset('js/app/tdocumento/index.js')}}" charset="utf-8"></script>
@stop
