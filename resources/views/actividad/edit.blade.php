<title>Nueva Actividad - Curso {{$master->cur_desc }}</title>

@extends('layouts.'.$layout)
@section('content')
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Curso: {{ $master->cur_desc }} - Actividad: {{ $data->act_titu }}</h3>
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
            {{Form::open(array('url' => 'actividad/save',"class" => "form-horizontal","enctype" => "multipart/form-data"))}}
            <input type="hidden" name="act_cont" id="act_cont" value="{{ $data->act_cont }}">
            <input type="hidden" name="cur_cont" id="cur_cont" value="{{ $data->cur_cont }}">
            <div class="form-group col-md-12 col-sm-12">
              <label for="act_img"> Cambiar imagen de portada (*)</label>
              <input id="act_img" name="act_img" class="form-control filestyle margin images" type="file" />
            </div>

            <div class="logo col-md-12 col-sm-12 form-group"  style="height: 400px;">
                <div style="height: 400px;">
                  @if ($data->act_img != null && $data->act_img != "")
                    <img class="images" id="image" src="{{asset('images/act_img/'.$data->act_img)}}" alt="Vista previa de la imagen seleccionada" width="100%" height="400px"/>
                  @else
                    <img class="images" id="image" src="#" alt="Vista previa de la imagen seleccionada" width="100%" height="400px"/>

                  @endif
                  <div class="clearfix"></div>

                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">

              <div class="form-group">
                <label for="act_titu"> Título de Actividad (*)</label>
                <input type="text" name="act_titu" id="act_titu" class="form-control" value="{{ $data->act_titu }}">
              </div>
              <div class="form-group">
                <label for="act_desc"> Descripción de Actividad (*)</label>
                <textarea name="act_desc" id="act_desc" rows="8" cols="80" class="form-control">{{ $data->act_desc }}</textarea>
              </div>
                <div class="form-group col-md-4 col-sm-12">
                  <label for="act_fini"> Inicio de actividad (*) {{ str_replace(' ', 'T',$data->act_fini->format('Y-m-dTH:i')) }}</label>
                  <input type="datetime-local" name="act_fini" id="act_fini" class="form-control col-md-6 col-sm-12" value="{{ str_replace(' ', 'T',$data->act_fini->format('Y-m-d H:i')) }}">


                </div>

                <div class="form-group col-md-4 col-sm-12">
                  <label for="act_fina"> Finalización de la actividad (*)</label>
                  <input type="datetime-local" name="act_fina" id="act_fina" class="form-control col-md-6 col-sm-12" value="{{ str_replace(' ', 'T',$data->act_fina->format('Y-m-d H:i')) }}">

                </div>

                <div class="form-group col-md-4 col-sm-12">
                  <label for="act_vali"> Número de intentos por estudiante (*)</label>
                  <input type="number" name="act_vali" id="act_vali" class="form-control col-md-6 col-sm-12" value="{{ $data->act_vali }}">


                </div>
                <div class="form-group">
                  <label for="act_file"> Archivo actual: </label>
                  <div class="">
                    @if ($data->act_file != null && $data->act_file != "")
                      <a href="{{route('actdownload',['act_file' => $data->act_file])}}" class="btn btn-link ">
                        @if (pathinfo($data->act_file)["extension"] == "docx" || pathinfo($data->act_file)["extension"] == "doc")
                        <i class="fa fa-file-word-o "></i> {{ $data->act_titu }}

                        @elseif (pathinfo($data->act_file)["extension"] == "xlsx" || pathinfo($data->act_file)["extension"] == "xls")
                        <i class="fa fa-file-excel-o "></i> {{ $data->act_titu }}

                        @elseif (pathinfo($data->act_file)["extension"] == "pptx" || pathinfo($data->act_file)["extension"] == "ppt")
                        <i class="fa fa-file-powerpoint-o "></i> {{ $data->act_titu }}

                        @elseif (pathinfo($data->act_file)["extension"] == "pdf")
                        <i class="fa fa-file-pdf-o "></i> {{ $data->act_titu }}

                        @elseif (pathinfo($data->act_file)["extension"] == "zip" || pathinfo($data->act_file)["extension"] == "rar")
                        <i class="fa fa-file-archive-o "></i> {{ $data->act_titu }}

                        @endif
                      </a>

                    @else
                      <i class="fa fa-file-archive-o "></i> No existe archivo asociado
                    @endif

                    <div class="clearfix"></div>
                  </div>

                </div>
                <div class="form-group">
                  <label for="act_file"> Cambiar archivo o documento como recurso educativo (opcional)</label>
                  <input id="act_file" name="act_file" class="form-control" type="file"/>
                </div>

            </div>


            <div class="col-md-6 col-sm-12 col-xs-12">

              <div class="form-group">
                <label for="act_vid"> Cambiar video como recurso educativo (opcional)</label>
                <input id="act_vid" name="act_vid" class="form-control video margin images" type="file" />
              </div>

                <div class="form-group">
                  <a onclick="limpiarVideo()" class="btn btn-primary"> Quitar video</a>
                  <center>
                    <video height="300px" controls preload id="video" align="center" width="100%">
                      @if ($data->act_vid != null && $data->act_vid != "")
                        <source src="{{asset('images/act_vide/'.$data->act_vid)}}" type="video/mp4" >
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
