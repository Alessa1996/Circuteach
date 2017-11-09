<title>Creación de Personas</title>

@extends('layouts.'.$layout)
@section('content')
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Creación de Personas</h3>
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
            {{Form::open(array('url' => 'persona/save',"class" => "form-horizontal"))}}
            <input type="hidden" name="ter_cont" id="ter_cont" value="">
            <div class="form-group col-md-3 col-sm-12">
              <label for="tdo_cont">Tipo de Documento</label>
              {{Form::select('tdo_cont', $f_tdoc, null, ['class' => 'form-control','placeholder' => 'Seleccione un Documento', 'id' => 'tdo_cont'])}}
            </div>
            <div class="form-group col-md-3 col-sm-12">
              <label for="ter_iden"> Nº de Documento</label>
              <input type="number" name="ter_iden" id="ter_iden" value="" class="form-control">
            </div>
            <div class="clearfix"></div>
              <div class="form-group col-md-3 col-sm-12">
                <label for="ter_pnom"> Primer Nombre (*)</label>
                <input type="text" name="ter_pnom" id="ter_pnom" value="" class="form-control">
              </div>
              <div class="form-group col-md-3 col-sm-12">
                <label for="ter_snom"> Segundo Nombre (Opcional)</label>
                <input type="text" name="ter_snom" id="ter_snom" value="" class="form-control">
              </div>
              <div class="form-group col-md-3 col-sm-12">
                <label for="ter_pnom"> Primer Apellido (*)</label>
                <input type="text" name="ter_pape" id="ter_pape" value="" class="form-control">
              </div>
              <div class="form-group col-md-3 col-sm-12">
                <label for="ter_pape"> Segundo Apellido (*)</label>
                <input type="text" name="ter_sape" id="ter_sape" value="" class="form-control">
              </div>
              <div class="form-group col-md-4 col-sm-12">
                <label for="ter_corre"> Correo Electrónico (*)</label>
                <input type="email" name="ter_corre" id="ter_corre" value="" class="form-control">
              </div>
              <div class="form-group col-md-4 col-sm-12">
                <label for="ter_tel"> Número de Contacto (*)</label>
                <input type="number" name="ter_tel" id="ter_tel" value="" class="form-control">
              </div>
              <div class="form-group col-md-4 col-sm-12">
                <label for="tdo_cont">Tipo de Usuario (*)</label>
                {{Form::select('tus_cont', $f_tusu, null, ['class' => 'form-control','placeholder' => 'Seleccione tipo de usuario', 'id' => 'tus_cont'])}}
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
                  <th><center>Documento</center></th>
                  <th><center>Nombres</center></th>
                  <th><center>Apellidos</center></th>
                  <th><center>Opciones</center></th>
                </tr>
              </thead>
              <tbody>
                @forelse ($data as $data)
                <tr>
                  <td>{{ $data->ter_cont }}</td>
                  <td>{{ $data->ter_iden }}</td>
                  <td>{{ strtoupper($data->ter_pnom) }} {{ strtoupper($data->ter_snom)}}</td>
                  <td>{{ strtoupper($data->ter_pape) }} {{ strtoupper($data->ter_sape)}}</td>
                  <td>
                    <center>
                      <a onclick="show({{ $data->ter_cont}})" class="btn btn-warning btn-xs"> Ver/Actualizar</a>
                      <a onclick="del({{ $data->ter_cont}})" class="btn btn-danger btn-xs"> Eliminar</a>
                    </center>
                  </td>
                </tr>
                @empty
                    <tr>
                      <td colspan="5"><center>No hay Registros</center></td>
                    </tr>
                @endforelse
              </tbody>
            </table>

          </div>
        </div>
      </div>
      </div>

      </div>


      <script src="{{asset('js/app/persona/index.js')}}" charset="utf-8"></script>
@stop
