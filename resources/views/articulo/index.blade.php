<title>Artículo | Mis Artículos</title>

@extends('layouts.'.$layout)
@section('content')
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Creación de artículos de interés general</h3>
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
            <div class="form-group col-md-4 col-sm-12">
              <label for=""> Nombre de Usuario</label>
              <p class="form-control">{{ $user->ter_pape }} {{ $user->ter_sape }} {{ $user->ter_pnom }} {{ $user->ter_snom }}</p>
            </div>

            <div class="clearfix"></div>

          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Articulos Subidos</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <a href="{{ route('artnew') }}">
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
                      <p><center>Nuevo articulo</center></p>
                      <div class="text-center">
                        <a href="{{ route('artnew') }}" class="btn btn-primary btn-xs">Click aquí!</a>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              @forelse($data as $data)
              <a href="{{ route('artshow',['act_cont' => $data->art_cont]) }}">
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
                      <div class="text-center">
                        <a href="{{ route('artshow',['art_cont' => $data->art_cont]) }}" class="btn btn-default btn-xs"><i class="fa fa-search"></i></a>
                        <a href="{{ route('artedit',['art_cont' => $data->art_cont]) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                        <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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

@stop
