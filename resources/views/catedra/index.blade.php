<title>Asignación Asignatura-Docente (Creación de Cátedra)</title>

@extends('layouts.'.$layout)
@section('content')
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Asignación Asignatura-Docente (Creación de Cátedra)</h3>
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
            <h2>Formulario de Registro</h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            {{Form::open(array('url' => 'catedra/save',"class" => "form-horizontal"))}}
            <input type="hidden" name="cat_cont" id="cat_cont" value="">

            <div class="form-group col-md-6 col-sm-12">
              <label for="asi_cont"> Código de Asignatura (*)</label>
              {{Form::select('asi_cont', $f_asig, null, ['class' => 'form-control','placeholder' => 'Seleccione un estado', 'id' => 'asi_cont'])}}
            </div>
              <div class="form-group col-md-6 col-sm-12">
                <label for="doc_cont"> Nombre de Asignatura (Opcional)</label>
                {{Form::select('doc_cont', $f_doce, null, ['class' => 'form-control','placeholder' => 'Seleccione un estado', 'id' => 'doc_cont'])}}
              </div>
              <div class="form-group col-md-6 col-sm-12">
                <label for="nac_cont"> Nivel Académico (Curso) (*)</label>
                {{Form::select('nac_cont', $f_naca, null, ['class' => 'form-control','placeholder' => 'Seleccione un estado', 'id' => 'nac_cont'])}}
              </div>
              <div class="form-group col-md-6 col-sm-12">
                <label for="cat_esta">Estado de Asignatura (*)</label>
                {{Form::select('cat_esta', ["0" => "Inactivo","1" => "Activo"], null, ['class' => 'form-control','placeholder' => 'Seleccione un estado', 'id' => 'cat_esta'])}}
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


      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Registros en sistema</h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table class="datatable table table-striped" id="datatable">
              <thead>
                <tr>
                  <th><center>Nº</center></th>
                  <th><center>Cátedra</center></th>
                  <th><center>Docente</center></th>
                  <th><center>Opciones</center></th>
                </tr>
              </thead>
              <tbody>
                @forelse ($data as $data)
                <tr>
                  <td>{{ $data->cat_cont }}</td>
                  @php ($gn_doc = $data->gn_doce()->first()->gn_terc()->first())
                  <td>{{ $data->ac_asig()->first()->asi_desc }} - {{$data->gn_naca()->first()->nac_desc}}</td>
                  <td>{{ strtoupper($gn_doc->ter_pnom) }} {{ strtoupper($gn_doc->ter_snom) }} {{ strtoupper($gn_doc->ter_pape) }} {{ strtoupper($gn_doc->ter_sape) }}</td>
                  <td>
                    <center>
                      <a onclick="show({{ $data->cat_cont}})" class="btn btn-warning btn-xs"> Ver/Actualizar</a>
                      <a onclick="del({{ $data->cat_cont}})" class="btn btn-danger btn-xs"> Eliminar</a>
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
      </div>

      </div>


      <script src="{{asset('js/app/catedra/index.js')}}" charset="utf-8"></script>
@stop
