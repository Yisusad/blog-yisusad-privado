@extends('plantilla')

@section('content')

<div class="content-wrapper" style="min-height: 247px;">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Categorias</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>

            <li class="breadcrumb-item active">Categorias</li>

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

              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearCategoria">Crear Nueva Categoria</button>

            </div>

            <div class="card-body">

              {{-- @foreach ($categorias as $element)
                  {{ $element }}
                @endforeach --}}
            
              <table class="table table-bordered table-striped dt-responsive" id="tablaCategorias" width="100%">
                <thead>
                  <tr>
                    <th width="10px">#</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Palabras Claves</th>
                    <th>Ruta</th>
                    <th width="200px">Imagen</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>

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