<title>Entrega | Ver: {{$data->ent_titu }}</title>

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
            <h2>Detalle de Entrega</h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <div style="height: 400px;">
                            @if ($data->ent_img != null && $data->ent_img != "")
                              <img class="images" id="image" src="{{asset('images/ent_img/'.$data->ent_img)}}" alt="Vista previa de la imagen seleccionada" width="100%" height="400px"/>
                            @else
                              <img class="images" id="image" src="#" alt="El artículo no tiene una imagen de portada" width="100%" height="400px"/>

                            @endif
                            <div class="clearfix"></div>

                          </div>
                          <h1>
                                          <i class="fa fa-info"></i> {{ $data->ent_titu }}.
                                          <small class="pull-right">Fecha de Inicio: {{ $data->ent_fec }}</small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          Detalles del creador
                          <address>
                              @php ($terc = $data->cu_matri()->first()->gn_estu()->first()->gn_terc()->first())
                              <strong>{{ $terc->ter_pnom }} {{ $terc->ter_snom }} {{ $terc->ter_pape }} {{ $terc->ter_sape }}</strong>
                              <br>Email: {{ $terc->ter_corre }}
                          </address>
                        </div>

                        @if ($user != null)
                          @if ($user->ter_cont == $terc->ter_cont or $doce==true)
                            <div class="col-sm-4 invoice-col">
                              Calificación
                              <strong>
                                @if ($data->ent_cali != null && $data->ent_cali != "")
                                  <p style="color: green;">{{$data->ent_cali}}</p>
                                @else
                                  <p style="color: red;">Sin Calificar</p>
                                @endif
                              </strong>
                            </div>
                          @endif
                        @endif


                        <!-- /.col -->
                      </div>

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-12">
                          <p class="lead">Descripción de la entrega:</p>
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            {!! nl2br($data->ent_desc) !!}
                          </p>
                        </div>
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="ln_solid"></div>
                      <div class="row">
                        <div class="col-xs-12 table">
                          <p class="lead">Archivos incluidos en la entrega:</p>

                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Tipo de Archivo</th>
                                <th style="width: 59%">Nombre de archivo</th>
                                <th>Opciones</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if (($data->ent_file != null && $data->ent_file != "") || ($data->ent_vid != null && $data->ent_vid != ""))
                                @if ($data->ent_vid != null && $data->ent_vid != "")
                                  <tr>
                                    <td>Video</td>
                                    <td>{{ $data->ent_titu.".".pathinfo($data->ent_vid)["extension"] }}</td>
                                    <td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-video-camera"></i> Ver video</a></td>
                                  </tr>
                                @endif
                                @if ($data->ent_file != null && $data->ent_file != "")
                                <tr>
                                  <td>Archivo / Documento</td>
                                  <td>{{ $data->ent_titu.".".pathinfo($data->ent_file)["extension"] }}</td>
                                  <td><a class="btn btn-primary btn-sm" href="{{route('entdownload',['ent_file' => $data->ent_file])}}"><i class="fa fa-download"></i> Descargar</a></td>
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

                      @if ($data->ent_vid != null && $data->ent_vid != "")
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
                                  <source src="{{asset('images/ent_vide/'.$data->ent_vid)}}" type="video/mp4" >
                                    Tu navegador no soporta la etiqueta HTML5 video.
                                </video>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Volver al contenido</button>
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
                            @if ($user->ter_cont == $terc->ter_cont)
                              <a class="btn btn-warning pull-right" href="{{ route('entedit',['act_cont' => $master->act_cont,'ent_cont' => $data->ent_cont]) }}"><i class="fa fa-pencil-square-o"></i> Editar contenido</a>
                            @endif
                          @endif

                          @if ($doce == true)

                            @if ($data->ent_cali == null || $data->ent_cali == "")
                              <a class="btn btn-primary pull-right" data-toggle="modal" data-target="#calificar"><i class="fa fa-check"></i> Calificar Entrega</a>
                              <div class="modal fade bs-example-modal-sm" id="calificar" tabindex="-1" role="dialog" aria-hidden="true">
                                 <div class="modal-dialog modal-md">
                                   <div class="modal-content">

                                     <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                       </button>
                                       <h4 class="modal-title" id="myModalLabel2">Calificación</h4>
                                     </div>
                                     <div class="modal-body">
                                       {{Form::open(array('url' => route('entcalificar')))}}
                                       <input type="hidden" name="ent_cont" id="ent_cont" value="{{$data->ent_cont}}">
                                       <div class="form-group">
                                         <label for="ent_cali"> Calificación</label>
                                         <input type="number" class="form-control" name="ent_cali" id="ent_cali" value="" step=any>
                                       </div>

                                       <div class="form-group">
                                         <label for="ent_obser"> Observaciones</label>
                                         <textarea name="name" id="ent_obser" name="ent_obser" rows="8" class="form-control" style="resize: none;"></textarea>
                                       </div>


                                     </div>
                                     <div class="modal-footer">
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                       <button type="submit" class="btn btn-primary">Enviar Calificación</button>
                                     </div>
                                     {{Form::close()}}
                                   </div>
                                 </div>
                               </div>
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
