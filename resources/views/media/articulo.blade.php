<title>Todos Nuestros Videos Sobre Artículos</title>

@extends('layouts.'.$layout)
@section('content')


<div class="">

  @php($current = $data->currentPage())
  @php($next = $data->nextPageUrl())
  @php($back = $data->previousPageUrl())
  @php($last = $data->lastPage())

  @php($data->setPath(''))


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
            @forelse ($data as $data)
              <a href="{{ route('player',['env' => 'articulo','id' => sha1($data->art_cont)]) }}">

                <div class="col-md-12">
                  <div class="col-md-2 col-sm-4 col-sm-12" style=" vertical-align: middle; align-items: center;">
                    @if($data->art_img != null and $data->art_img != "")
                      <img src="{{asset('images/art_img/'.$data->art_img)}}" class="img-responsive" alt="...">

                    @else
                    <center>
                      <img src="{{asset('images/art_img/no_image.png')}}" class="img-responsive" alt="..." style="width: 160px; padding-top: 50px;" >
                    </center>
                    @endif
                  </div>

                  <div class="col-md-4 col-xs-12 col-sm-12">
                    <h3>{{$data->art_titu}}</h3>
                    @php($terc = $data->gn_terc()->first())
                    @php($nombre = $terc->ter_pnom." ".$terc->ter_snom." ".$terc->ter_pape." ".$terc->ter_sape)
                    <p>{!! nl2br($data->art_desc) !!}</p>
                    <p><strong>Subido por:</strong><br>
                      {{$nombre}}
                    </p>
                    <p><strong>Fecha de Subida:</strong><br>
                      {{$data->art_fec}}
                    </p>

                  <a href="{{route('player',['env' => 'articulo','id' => sha1($data->art_cont)])}}" class="btn btn-primary pull-right"> Abrir / Ver</a>
                </div>


              </a>
              <div class="clearfix"></div>
              <div class="ln_solid"></div>
            @empty
              <div class="text-center">
                <h2> No existen videos en nuestros registros</h2>
              </div>
            @endforelse
                <div class="">
                  <p class="text-center">
                    @if ($current > 1)
                    <a href="{{route('artmedia',['page'=> 1])}}" class="btn btn-primary btn-sm"> Primera</a>

                    @endif
                    @if ($back != null)
                    <a href="{{$back}}" class="btn btn-primary btn-sm"> Anterior</a>
                    @endif
                    .:: Página {{$current}} de {{$last}} ::.
                    @if ($next != null)
                    <a href="{{$next}}" class="btn btn-primary btn-sm"> Siguiente</a>

                    @endif
                    @if($last > $current)
                      <a href="{{route('artmedia',['page'=> $last])}}" class="btn btn-primary btn-sm"> Última</a>
                    @endif
                  </p>
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>


<script src="{{asset('js/app/tdocumento/index.js')}}" charset="utf-8"></script>
@stop
