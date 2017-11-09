<title>Reproducir: {{$data[1]}}</title>

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
          <h2>Reproductor de Video</h2>

          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-12">
              <video height="300px" autoplay controls preload id="video" align="center" width="100%">
                  <source src="{{asset($data[5])}}" type="video/mp4" >
                  Tu navegador no soporta la etiqueta HTML5 video.
              </video>
              <div class="clearfix"></div>
              <div class="ln_solid"></div>
              <div class="col-md-6">
                <h2>{{$data[1]}}</h2>
                <p><strong>Autor:</strong> <br>
                  {{$data[3]}}</p>
                <p><strong>Correo:</strong> <br>
                  {{$data[4]}}</p>

              </div>

              <div class="col-md-6">
                <p><strong>Descripción:</strong> <br>
                  {{$data[2]}}</p>
              </div>
              <div class="clearfix"></div>
                <a href="{{ $data[6]}}">
                  <div class="btn-link">
                    <p class="text-center">
                      Ver completo...
                    </p>
                  </div>
                </a>
            </div>

          </div>
        </div>
      </div>
    </div>


  </div>

</div>


<script src="{{asset('js/app/tdocumento/index.js')}}" charset="utf-8"></script>
@stop
