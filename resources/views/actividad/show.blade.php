<title>Actividad | Ver: {{$data->act_titu }}</title>

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
            <h2>Detalle de Actividad</h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <div style="height: 400px;">
                            @if ($data->act_img != null && $data->act_img != "")
                              <img class="images" id="image" src="{{asset('images/act_img/'.$data->act_img)}}" alt="Vista previa de la imagen seleccionada" width="100%" height="400px"/>
                            @else
                              <img class="images" id="image" src="#" alt="El artículo no tiene una imagen de portada" width="100%" height="400px"/>

                            @endif
                            <div class="clearfix"></div>

                          </div>
                          <h1>
                                          <i class="fa fa-info"></i> {{ $data->act_titu }}.
                                          <small class="pull-right">Fecha de Inicio: {{ $data->act_fini }}</small><br>
                                          <small class="pull-right">Fecha de Fin: {{ $data->act_fina }}</small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          Detalles del creador
                          <address>
                              @php ($terc = $master->ac_cate()->first()->gn_doce()->first()->gn_terc()->first())
                              <strong>{{ $terc->ter_pnom }} {{ $terc->ter_snom }} {{ $terc->ter_pape }} {{ $terc->ter_sape }}</strong>
                              <br>Email: {{ $terc->ter_corre }}
                          </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                          <label for="">Entregas Recibidas</label>
                          <address>
                            <p>
                            @if ($data->cu_entrs != null)
                              {{ $data->cu_entrs->count()}} / {{ $data->ac_curs()->first()->cu_matris->count()}}
                            @else
                              0
                            @endif</p>
                            <a href="{{route('entindex',['act_cont'=>$data->act_cont])}}" class="btn btn-success"><i class="fa fa-search"></i> Ir a tus entregas</a>
                          </address>
                        </div>
                        <!-- /.col -->
                      </div>

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-12">
                          <p class="lead">Descripción de la actividad:</p>
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            {{ $data->act_desc }}
                          </p>
                        </div>
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="ln_solid">

                      </div>
                      <div class="row">
                        <div class="col-xs-12 table">
                          <p class="lead">Archivos incluidos en la actividad:</p>

                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Tipo de Archivo</th>
                                <th style="width: 59%">Nombre de archivo</th>
                                <th>Opciones</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if (($data->act_file != null && $data->act_file != "") || ($data->act_vid != null && $data->act_vid != ""))
                                @if ($data->act_file != null && $data->act_file != "")
                                  <tr>
                                    <td>Video</td>
                                    <td>{{ $data->act_titu.".".pathinfo($data->act_vid)["extension"] }}</td>
                                    <td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-video-camera"></i> Ver video</a></td>
                                  </tr>
                                @endif
                                @if ($data->act_vid != null && $data->act_vid != "")
                                <tr>
                                  <td>Archivo / Documento</td>
                                  <td>{{ $data->act_titu.".".pathinfo($data->act_file)["extension"] }}</td>
                                  <td><a class="btn btn-primary btn-sm" href="{{route('artdownload',['act_file' => $data->act_file])}}"><i class="fa fa-download"></i> Descargar</a></td>
                                </tr>
                                @endif


                              @else
                                <tr>
                                  <td colspan="3">No Existen archivos vinculados a esta actividad</td>
                                </tr>
                              @endif

                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      @if ($data->act_vid != null && $data->act_vid != "")
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
                                  <source src="{{asset('images/act_vide/'.$data->act_vid)}}" type="video/mp4" >
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
                          @if ($user != null)
                            @if ($user->ter_cont == $terc->ter_cont || Session::get('profile') == "gn_admi")
                              <a class="btn btn-warning pull-right" href="{{ route('artedit',['act_cont' => $data->act_cont]) }}"><i class="fa fa-pencil-square-o"></i> Editar contenido</a>
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

@stop
