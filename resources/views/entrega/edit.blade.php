
<title>Editar Entrega - Actividad {{$master->act_titu }}</title>

@extends('layouts.'.$layout)
@section('content')
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Actividad: {{ $master->act_titu }} - Editar entrega | Número de intentos realizados: {{($master->act_vali == 0 ?  '(Sin límite de entrega)' : $data->ent_entr.' de '.$master->act_vali)}}</h3>
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
            {{Form::open(array('url' => 'entrega/save',"class" => "form-horizontal","enctype" => "multipart/form-data"))}}
            <input type="hidden" name="ent_cont" id="ent_cont" value="{{$data->ent_cont}}">
            <input type="hidden" name="act_cont" id="act_cont" value="{{ $master->act_cont }}">
            <div class="form-group col-md-12 col-sm-12">
              <label for="ent_img"> Imagen de portada (*)</label>
              <input id="ent_img" name="ent_img" class="form-control filestyle margin images" data-input="false" type="file" data-buttonText="Upload Logo" data-size="sm" data-badge="false" />
            </div>



            <div class="logo col-md-12 col-sm-12 form-group"  style="height: 400px;">
                <div style="height: 400px;">
                  @if ($data->ent_img != null && $data->ent_img != "")
                    <img class="images" id="image" src="{{asset('images/ent_img/'.$data->ent_img)}}" alt="Vista previa de la imagen seleccionada" width="100%" height="400px"/>
                  @else
                    <img class="images" id="image" src="#" alt="Vista previa de la imagen seleccionada" width="100%" height="400px"/>

                  @endif

                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">

              <div class="form-group">
                <label for="ent_titu"> Título de Entrega (*)</label>
                <input type="text" name="ent_titu" id="ent_titu" value="{{$data->ent_titu}}" class="form-control">
              </div>
              <div class="form-group">
                <label for="ent_desc"> Descripción de Entrega (*)</label>
                <textarea name="ent_desc" id="ent_desc" rows="8" cols="80" class="form-control">{{$data->ent_desc}}</textarea>
              </div>

              <div class="form-group">
                <label for="act_file"> Archivo actual: </label>
                <div class="">
                  @if ($data->ent_file != null && $data->ent_file != "")
                    <a href="{{route('actdownload',['act_file' => $data->act_file])}}" class="btn btn-link ">
                      @if (pathinfo($data->ent_file)["extension"] == "docx" || pathinfo($data->ent_file)["extension"] == "doc")
                      <i class="fa fa-file-word-o "></i> {{ $data->ent_titu }}

                      @elseif (pathinfo($data->ent_file)["extension"] == "xlsx" || pathinfo($data->ent_file)["extension"] == "xls")
                      <i class="fa fa-file-excel-o "></i> {{ $data->ent_titu }}

                      @elseif (pathinfo($data->ent_file)["extension"] == "pptx" || pathinfo($data->ent_file)["extension"] == "ppt")
                      <i class="fa fa-file-powerpoint-o "></i> {{ $data->ent_titu }}

                      @elseif (pathinfo($data->ent_file)["extension"] == "pdf")
                      <i class="fa fa-file-pdf-o "></i> {{ $data->ent_titu }}

                      @elseif (pathinfo($data->ent_file)["extension"] == "zip" || pathinfo($data->ent_file)["extension"] == "rar")
                      <i class="fa fa-file-archive-o "></i> {{ $data->ent_titu }}

                      @endif
                    </a>

                  @else
                    <i class="fa fa-file-archive-o "></i> No existe archivo asociado
                  @endif

                  <div class="clearfix"></div>
                </div>

              </div>

                <div class="form-group">
                  <label for="ent_file"> Archivo o documento como recurso educativo (opcional)</label>
                  <input id="ent_file" name="ent_file" class="form-control" type="file"/>
                </div>
            </div>


            <div class="col-md-6 col-sm-12 col-xs-12">

              <div class="form-group">
                <label for="ent_vid"> Video como recurso educativo (opcional)</label>
                <input id="ent_vid" name="ent_vid" class="form-control video margin images" type="file" />
              </div>

                <div class="form-group">
                  <a onclick="limpiarVideo()" class="btn btn-primary"> Quitar video</a>
                  <center>
                    <video height="300px" controls preload id="video" align="center" width="100%">
                      @if ($data->ent_vid != null && $data->ent_vid != "")
                        <source src="{{asset('images/ent_vide/'.$data->act_vid)}}" type="video/mp4" >
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
                <button type="submit" name="submit" class="btn btn-success"> Guardar</button>
                <button type="reset" name="reset" class="btn btn-danger"> Limpiar</button>
              </div>
            </div>




          </div>
        </div>
      </div>

    </div>

      </div>

      <script src="{{asset('js/app/entrega/index.js')}}" charset="utf-8"></script>
@stop
