@extends('plantilla')

@section('content')

<div class="content-wrapper" style="min-height: 247px;">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Administradores</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>

            <li class="breadcrumb-item active">Administradores</li>

          </ol>

        </div>

      </div>

    </div><!-- /.container-fluid -->

  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">

      <div class="row">

        <div class="col-12">

          <!-- Default box -->
          <div class="card">

            <div class="card-header">

              <button class="btn btn-primary btn-sm">Crear nuevo administrador</button>

            </div>

            <div class="card-body">

              <table class="table table-bordered table-striped dt-responsive tablaAdministradores" width="100%">

                <thead>

                  <tr>

                    <th>#</th>

                    <th>Nombre</th>

                    <th>Correo</th>

                    <th width="50px">Foto</th>

                    <th>Rol</th>

                    <th>Acciones</th>

                  </tr>

                </thead>

                <tbody>

                  @foreach ($administradores as $key => $value)
                  
                  <tr>

                    <td>{{($key+1)}}</td>

                    <td>{{($value["name"])}}</td>

                    <td>{{($value["email"])}}</td>

                    <td><img src="{{($value["foto"])}}" alt="foto admin" class="img-fluid rounded-circle"></td>
                    
                    <td>{{($value["rol"])}}</td>

                    <td>

                      <button class="btn btn-warning btn-sm">Editar</button>

                      <button class="btn btn-danger btn-sm">Eliminar</button>

                    </td>

                  </tr>

                  @endforeach

                </tbody>

              </table>

            </div>

            <!-- /.card-body -->
            <div class="card-footer">

              Footer

            </div>
            <!-- /.card-footer-->
          </div>
          <!-- /.card -->
        </div>

      </div>

    </div>

  </section>
  <!-- /.content -->
</div>

@endsection