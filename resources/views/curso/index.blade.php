<title>Creación de Cursos</title>

@extends('layouts.'.$layout)
@section('content')
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Creación de Cursos</h3>
      </div>

    </div>



    <!-- <div class="row"> -->
        <div class="flash-message" id="messages">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))

          <p class="alert alert-{{ $msg }} alert-dissmisable">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
      </div> <!-- end .flash-message -->


      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Formulario de Registro</h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            {{Form::open(array('url' => 'curso/save',"class" => "form-horizontal"))}}
            <input type="hidden" name="cur_cont" id="cur_cont" value="">

            <div class="form-group col-md-4 col-sm-12">
              <label for="doc_cont"> Docente (*)</label>
              {{Form::select('doc_cont', $f_doce, null, ['class' => 'form-control','placeholder' => 'Seleccione un estado', 'id' => 'doc_cont'])}}
            </div>

            <div class="form-group col-md-4 col-sm-12">
              <label for="cat_cont"> Cátedra (*)</label>
              {{Form::select('cat_cont', $f_naca, null, ['class' => 'form-control','placeholder' => 'Seleccione una cátedra', 'id' => 'cat_cont'])}}
            </div>
            <div class="clearfix"></div>
            <div class="form-group col-md-4 col-sm-12">
              <label for="cur_desc"> Nombre o Detalle de Curso (*)</label>
              <input type="text" name="cur_desc" id="cur_desc" value="" class="form-control">
            </div>

            <div class="form-group col-md-4 col-sm-12">
              <label for="cur_fini">Fecha de Inicio (*)</label>
              <input type="date" name="cur_fini" id="cur_fini" value="" class="form-control">
            </div>

            <div class="form-group col-md-4 col-sm-12">
              <label for="cur_fina"> Fecha de Finalización (*)</label>
              <input type="date" name="cur_fina" id="cur_fina" value="" class="form-control">
            </div>

            <div class="form-group col-md-4 col-sm-12">
              <label for="cur_esta"> Estado de Curso (*)</label>
              {{Form::select('cur_esta', ["0" => "Inactivo", "1" => "Activo"], null, ['class' => 'form-control','placeholder' => 'Seleccione un estado', 'id' => 'cur_esta'])}}
            </div>

            <div class="form-group col-md-8 col-sm-12">
              <label for="cur_obge"> Objetivo General (*)</label>
              <input type="text" name="cur_obge" id="cur_obge" value="" class="form-control">
            </div>

            <div class="form-group col-md-12 col-sm-12">
              <label for="cur_obge"> Objetivos específicos (*)</label>
              <textarea name="cur_obes" id="cur_obes" rows="8" style="resize:none;" class="form-control"></textarea>
            </div>


              <div class="form-group col-md-12 col-sm-12">
                <div class="ln_solid"></div>

                <center>
                  <button type="submit" name="submit" class="btn btn-success"> Guardar</button>
                  <button type="reset" name="reset" class="btn btn-danger"> Limpiar</button>
                </center>
              </div>
            {{Form::close()}}
          </div>
        </div>
      </div>


        <div class="x_panel">
          <div class="x_title">
            Registros en el sistema

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row col-md-12">
              <table class="table table-striped table-bordered dt-responsive nowrap" id="datatable">
                <thead>
                  <tr>
                    <th><center>Nº</center></th>
                    <th><center>Cátedra</center></th>
                    <th><center>Detalle de Curso</center></th>
                    <th><center>Docente Encargado</center></th>
                    <th><center>Opciones</center></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($data as $data)
                  @php($doce = $data->ac_cate()->first()->gn_doce()->first()->gn_terc()->first())
                  @php($asig = $data->ac_cate()->first()->ac_asig()->first())
                  @php($naca = $data->ac_cate()->first()->gn_naca()->first())
                  <tr>
                    <td>{{ $data->cur_cont }}</td>
                    <td>{{ $asig->asi_desc }} - {{ $naca->nac_desc }}</td>
                    <td>{{ $data->cur_desc }}</td>
                    <td>{{ ($doce->ter_pnom) }} {{ ($doce->ter_snom) }} {{ ($doce->ter_pape) }} {{ ($doce->ter_sape) }}</td>
                    <td>
                      <center>
                        <a onclick="show({{ $data->cur_cont}})" class="btn btn-warning btn-xs"> Ver/Actualizar</a>
                        <a onclick="del({{ $data->cur_cont}})" class="btn btn-danger btn-xs"> Eliminar</a>
                        <a href="{{route('actindex',['cur_cont' => $data->cur_cont])}}" class="btn btn-primary btn-xs"> Detalle de curso</a>
                      </center>
                    </td>
                  </tr>
                  @empty

                  @endforelse
                </tbody>
              </table>
            </div>

          </div>
        </div>
      <!-- </div> -->

      </div>


      <script src="{{asset('js/app/curso/index.js')}}" charset="utf-8"></script>
@stop
