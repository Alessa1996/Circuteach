<title>Artículo | Editar: {{$data->art_titu }}</title>

@extends('layouts.'.$layout)
@section('content')
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Editar Artículo: {{ $data->art_titu }}</h3>
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
            {{Form::open(array('url' => 'articulo/save',"class" => "form-horizontal","enctype" => "multipart/form-data"))}}
            <input type="hidden" name="art_cont" id="art_cont" value="{{ $data->art_cont }}">
            <div class="form-group col-md-12 col-sm-12">
              <label for="art_img"> Cambiar imagen de portada (*)</label>
              <input id="art_img" name="art_img" class="form-control filestyle margin images" type="file" />
            </div>

            <div class="logo col-md-12 col-sm-12 form-group"  style="height: 400px;">
                <div style="height: 400px;">
                  @if ($data->art_img != null && $data->art_img != "")
                    <img class="images" id="image" src="{{asset('images/art_img/'.$data->art_img)}}" alt="Vista previa de la imagen seleccionada" width="100%" height="400px"/>
                  @else
                    <img class="images" id="image" src="#" alt="Vista previa de la imagen seleccionada" width="100%" height="400px"/>

                  @endif
                  <div class="clearfix"></div>

                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">

              <div class="form-group">
                <label for="art_titu"> Título de Actividad (*)</label>
                <input type="text" name="art_titu" id="art_titu" class="form-control" value="{{ $data->art_titu }}">
              </div>
              <div class="form-group">
                <label for="art_desc"> Descripción de Actividad (*)</label>
                <textarea name="art_desc" id="art_desc" rows="8" cols="80" class="form-control">{{ $data->art_desc }}</textarea>
              </div>


                <div class="form-group">
                  <label for="art_file"> Archivo actual: </label>
                  <div class="">
                    @if ($data->art_file != null && $data->art_file != "")
                      <a href="{{route('artdownload',['art_file' => $data->art_file])}}" class="btn btn-link ">
                        @if (pathinfo($data->art_file)["extension"] == "docx" || pathinfo($data->art_file)["extension"] == "doc")
                        <i class="fa fa-file-word-o "></i> {{ $data->art_titu }}

                        @elseif (pathinfo($data->art_file)["extension"] == "xlsx" || pathinfo($data->art_file)["extension"] == "xls")
                        <i class="fa fa-file-excel-o "></i> {{ $data->art_titu }}

                        @elseif (pathinfo($data->art_file)["extension"] == "pptx" || pathinfo($data->art_file)["extension"] == "ppt")
                        <i class="fa fa-file-powerpoint-o "></i> {{ $data->art_titu }}

                        @elseif (pathinfo($data->art_file)["extension"] == "pdf")
                        <i class="fa fa-file-pdf-o "></i> {{ $data->art_titu }}

                        @elseif (pathinfo($data->art_file)["extension"] == "zip" || pathinfo($data->art_file)["extension"] == "rar")
                        <i class="fa fa-file-archive-o "></i> {{ $data->art_titu }}

                        @endif
                      </a>

                    @else
                      <i class="fa fa-file-archive-o "></i> No existe archivo asociado
                    @endif

                    <div class="clearfix"></div>
                  </div>

                </div>
                <div class="form-group">
                  <label for="art_file"> Cambiar archivo o documento como recurso educativo (opcional)</label>
                  <input id="art_file" name="art_file" class="form-control" type="file"/>
                </div>

            </div>


            <div class="col-md-6 col-sm-12 col-xs-12">

              <div class="form-group">
                <label for="art_vid"> Cambiar video como recurso educativo (opcional)</label>
                <input id="art_vid" name="art_vid" class="form-control video margin images" type="file" />
              </div>

                <div class="form-group">
                  <a onclick="limpiarVideo()" class="btn btn-primary"> Quitar video</a>
                  <center>
                    <video height="300px" controls preload id="video" align="center" width="100%">
                      @if ($data->art_vid != null && $data->art_vid != "")
                        <source src="{{asset('images/art_vide/'.$data->art_vid)}}" type="video/mp4" >
                        Tu navegador no soporta la etiqueta HTML5 video.
                      @else
                        <source src="#" type="video/mp4" >
                        Tu navegador no soporta la etiqueta HTML5 video.
                      @endif
                    </video>
                  </center>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="center-block text-center">
                <a onclick="window.history.back();" class="btn btn-default"> Volver Atrás</a>
                <button type="submit" name="submit" class="btn btn-success"> Guardar</button>
                <button type="reset" name="reset" class="btn btn-danger"> Limpiar</button>
              </div>
            </div>




          </div>
        </div>
      </div>

    </div>

      </div>

      <script src="{{asset('js/app/actividad/edit.js')}}" charset="utf-8"></script>
@stop
