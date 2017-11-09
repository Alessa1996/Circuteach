<title>Artículo | Ver: {{$data->art_titu }}</title>

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
            <h2>Detalle de Artículo</h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <div style="height: 400px;">
                            @if ($data->art_img != null && $data->art_img != "")
                              <img class="images" id="image" src="{{asset('images/art_img/'.$data->art_img)}}" alt="Vista previa de la imagen seleccionada" width="100%" height="400px"/>
                            @else
                              <img class="images" id="image" src="#" alt="El artículo no tiene una imagen de portada" width="100%" height="400px"/>

                            @endif
                            <div class="clearfix"></div>

                          </div>
                          <h1>
                                          <i class="fa fa-info"></i> {{ $data->art_titu }}.
                                          <small class="pull-right">Fecha de inclusión: {{ $data->art_fec }}</small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          Detalles del creador
                          <address>
                              @php ($terc = $data->gn_terc()->first())
                              <strong>{{ $terc->ter_pnom }} {{ $terc->ter_snom }} {{ $terc->ter_pape }} {{ $terc->ter_sape }}</strong>
                              <br>Email: {{ $terc->ter_corre }}
                          </address>
                        </div>
                        <!-- /.col -->
                      </div>

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-12">
                          <p class="lead">Descripción del artículo:</p>
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            {{ $data->art_desc }}
                          </p>
                        </div>
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="ln_solid">

                      </div>
                      <div class="row">
                        <div class="col-xs-12 table">
                          <p class="lead">Archivos incluidos en el artículo:</p>

                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Tipo de Archivo</th>
                                <th style="width: 59%">Nombre de archivo</th>
                                <th>Opciones</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if (($data->art_file != null && $data->art_file != "") || ($data->art_vid != null && $data->art_vid != ""))
                                @if ($data->art_vid != null && $data->art_vid != "")
                                  <tr>
                                    <td>Video</td>
                                    <td>{{ $data->art_titu.".".pathinfo($data->art_vid)["extension"] }}</td>
                                    <td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-video-camera"></i> Ver video</a></td>
                                  </tr>
                                @endif
                                @if ($data->art_file != null && $data->art_file != "")
                                <tr>
                                  <td>Archivo / Documento</td>
                                  <td>{{ $data->art_titu.".".pathinfo($data->art_file)["extension"] }}</td>
                                  <td><a class="btn btn-primary btn-sm" href="{{route('artdownload',['art_file' => $data->art_file])}}"><i class="fa fa-download"></i> Descargar</a></td>
                                </tr>
                                @endif


                              @else
                                <tr>
                                  <td colspan="3">No Existen archivos vinculados a este artículo</td>
                                </tr>
                              @endif

                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      @if ($data->art_vid != null && $data->art_vid != "")
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Video</h4>
                              </div>
                              <div class="modal-body">

                                <video height="300px" controls preload id="video" align="center" width="100%">
                                  <source src="{{asset('images/art_vide/'.$data->art_vid)}}" type="video/mp4" >
                                    Tu navegador no soporta la etiqueta HTML5 video.
                                </video>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Volver al artículo</button>
                              </div>

                            </div>
                          </div>
                        </div>
                      @endif



                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <a onclick="window.history.back();" class="btn btn-default"> Volver Atrás</a>
                          @if ($user && $user != null)
                            @if ($user->ter_cont == $data->ter_cont)
                            <a class="btn btn-warning pull-right" href="{{ route('artedit',['art_cont' => $data->art_cont]) }}"><i class="fa fa-pencil-square-o"></i> Editar contenido</a>
                            @endif
                          @endif
                        </div>
                      </div>
                    </section>
          </div>
        </div>
      </div>

    </div>

      </div>

      <script src="{{asset('js/app/actividad/edit.js')}}" charset="utf-8"></script>
@stop
