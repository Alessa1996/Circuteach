<title>Nueva Actividad - Curso {{$master->cur_desc }}</title>

@extends('layouts.'.$layout)
@section('content')
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Curso: {{ $master->cur_desc }} - Nueva actividad</h3>
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
            <input type="hidden" name="act_cont" id="act_cont" value="">
            <input type="hidden" name="cur_cont" id="cur_cont" value="{{ $master->cur_cont }}">
            <div class="form-group col-md-12 col-sm-12">
              <label for="act_img"> Imagen de portada (*)</label>
              <input id="act_img" name="act_img" class="form-control filestyle margin images" data-input="false" type="file" data-buttonText="Upload Logo" data-size="sm" data-badge="false" />
            </div>

            <div class="logo col-md-12 col-sm-12 form-group"  style="height: 400px;">
                <a onclick="limpiarImagen()" class="btn btn-primary"> Quitar imagen</a>
                <div style="height: 400px;">
                  <img class="images" id="image" src="#" alt="Vista previa de la imagen seleccionada"/>
                  <div class="clearfix"></div>

                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">

              <div class="form-group">
                <label for="act_titu"> Título de Actividad (*)</label>
                <input type="text" name="act_titu" id="act_titu" value="" class="form-control">
              </div>
              <div class="form-group">
                <label for="act_desc"> Descripción de Actividad (*)</label>
                <textarea name="act_desc" id="act_desc" rows="8" cols="80" class="form-control"></textarea>
              </div>
                <div class="form-group col-md-4 col-sm-12">
                  <label for="act_fini"> Inicio de actividad (*)</label>
                  <input type="date" name="act_fini" id="act_fini" value="" class="form-control col-md-6 col-sm-12">


                </div>

                <div class="form-group col-md-4 col-sm-12">
                  <label for="act_fina"> Finalización de la actividad (*)</label>
                  <input type="date" name="act_fina" id="act_fina" value="" class="form-control col-md-6 col-sm-12">

                </div>

                <div class="form-group col-md-4 col-sm-12">
                  <label for="act_vali"> Número de intentos por estudiante (*)</label>
                  <input type="number" name="act_vali" id="act_vali" value="" class="form-control col-md-6 col-sm-12">


                </div>
                <div class="form-group">
                  <label for="act_file"> Archivo o documento como recurso educativo (opcional)</label>
                  <input id="act_file" name="act_file" class="form-control" type="file"/>
                </div>
            </div>


            <div class="col-md-6 col-sm-12 col-xs-12">

              <div class="form-group">
                <label for="act_vid"> Video como recurso educativo (opcional)</label>
                <input id="act_vid" name="act_vid" class="form-control video margin images" type="file" />
              </div>

                <div class="form-group">
                  <a onclick="limpiarVideo()" class="btn btn-primary"> Quitar video</a>
                  <center>
                    <video height="300px" controls preload id="video" align="center" width="100%">
                        <source src="#" type="video/mp4" >
                        Tu navegador no soporta la etiqueta HTML5 video.
                    </video>
                  </center>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="center-block text-center">
                <button type="submit" name="submit" class="btn btn-success"> Guardar</button>
                <button type="reset" name="reset" class="btn btn-danger"> Limpiar</button>
              </div>
            </div>




          </div>
        </div>
      </div>

    </div>

      </div>

      <script src="{{asset('js/app/actividad/index.js')}}" charset="utf-8"></script>
@stop
