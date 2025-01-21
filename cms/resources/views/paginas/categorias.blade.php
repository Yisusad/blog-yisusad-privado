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
          </div>
          <!-- /.card -->
        </div>

      </div>

    </div>

  </section>
  <!-- /.content -->
</div>


<!-- MODAL PARA CREAR Categorías -->

<div class="modal" id="crearCategoria">
 
  <div class="modal-dialog">
   
    <div class="modal-content">

      <form method="POST" action="{{url('/')}}/categorias" enctype="multipart/form-data">
        @csrf
      
        <div class="modal-header bg-info">
          
          <h4 class="modal-title">Crear Categorías</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <div class="modal-body">

            {{-- Titulo de Categoría --}}

            <div class="input-group mb-3">
              
              <div class="input-group-append input-group-text">               
                 <i class="fas fa-list-ul"></i>
              </div>

              <input type="text" class="form-control" name="titulo_categoria" placeholder="Ingrese título de la categoría" value="{{ old('titulo_categoria') }}" required>

            </div>

            {{-- Descripción de Categoría --}}

            <div class="input-group mb-3">
              
              <div class="input-group-append input-group-text">               
                 <i class="fas fa-pencil-alt"></i>
              </div>

              <input type="text" class="form-control" name="descripcion_categoria" placeholder="Ingrese descripción de la categoría" value="{{ old('descripcion_categoria') }}" maxlength="30" required>

            </div>

            {{-- Ruta Categoría --}}

            <div class="input-group mb-3">
              
              <div class="input-group-append input-group-text">               
                <i class="fas fa-link"></i>
              </div>
  
              <input type="text" class="form-control inputRuta" name="ruta_categoria" placeholder="Ingrese ruta de la categoría" value="{{ old('ruta_categoria') }}" maxlength="30" required>
  
            </div>

            <hr class="pb-2">

            {{-- Palabras Claves de Categoría --}}

            <div class="input-group mb-3">
              
              <label>Palabras Claves <span class="small">(Separar por comas)</span></label>
  
              <input type="text" class="form-control" name="p_claves_categoria" value="categoria" data-role="tagsinput" required>
  
            </div>

            <hr class="pb-2">

            {{-- Imagen de Categoría --}}

            <div class="form-group my-2 text-center">
              
              <div class="btn btn-default btn-file">               
                <i class="fas fa-paperclip"></i>Agregar Imagen
                <input type="file" name="img_categoria" required>
              </div>
              
              <img class="previsualizarImg_img_categoria img-fluid py-2">
              <p class="help-block small">Dimensiones: 1024px * 576px | Peso Max. 2MB | Formato: JPG o PNG</p>

            </div>        

        </div>

        <div class="modal-footer d-flex">
          
          <div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>

          <div>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>

        </div>

      </form>

    </div> 

  </div> 

</div>

<!-- Notie Js Notificaciones comienzo -->
@if (Session::has("ok-crear"))

<script>
    notie.alert({ type: 1, text: '¡La categoría ha sido creada correctamente!', time: 10 })
</script>

@endif

@if (Session::has("no-validacion"))

<script>
    notie.alert({ type: 2, text: '¡Hay campos no válidos en el formulario!', time: 10 })
</script>

@endif

@if (Session::has("error"))

  <script>
      notie.alert({ type: 3, text: '¡Error en el gestor de categorías!', time: 10 })
 </script>

@endif
<!-- Notie Js Notificaciones fin -->

@endsection