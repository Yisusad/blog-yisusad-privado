@extends('plantilla')

@section('content')

<div class="content-wrapper" style="min-height: 247px;">

   <!-- Content Header (Page header) -->
  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 class="m-0 text-dark">Opiniones</h1>
          
        </div><!-- /.col -->
        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="{{ url("/") }}">Inicio</a></li>

            <li class="breadcrumb-item active">Opiniones</li>

          </ol>

        </div><!-- /.col -->

      </div><!-- /.row -->

    </div><!-- /.container-fluid -->

  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">

    <div class="container-fluid">

      <div class="row">

        <div class="col-lg-12">

          <div class="card card-primary card-outline">

            <div class="card-body">

              <table class="table table-bordered table-striped dt-responsive" id="tablaOpiniones" width="100%">

                <thead>

                  <tr>

                    <th width="10px">#</th>
                    <th>Artículo</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Foto</th>  
                    <th>Opinión</th> 
                    <th>Fecha Opinión</th> 
                    <th>Aprobación</th> 
                    <th>Administrador</th> 
                    <th>Respuesta</th>
                    <th>Fecha Respuesta</th>                 
                    <th>Acciones</th>         

                  </tr> 

                </thead>  

              </table>

      
            </div>

          </div>

        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->

  </div>
  <!-- /.content -->
</div>

<!--=====================================
Responder Opinión
======================================-->

@if (isset($status))
                 
  @if ($status == 200)
    
    @foreach ($opiniones as $key => $value)

      <div class="modal" id="responderOpinion">

      <div class="modal-dialog modal-lg">

        <div class="modal-content">

           <form action="{{url('/')}}/opiniones/{{$value->id_opinion}}" method="post" enctype="multipart/form-data">

              @method('PUT')

              @csrf

            <div class="modal-header bg-info">
              <h4 class="modal-title">Responder Opinión</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

              {{-- Descripción artículo --}}
                      
              <div class="input-group mb-3">
         
                <div class="input-group-append input-group-text">
                  <i class="fas fa-pencil-alt"></i>
                </div>

                <input type="text" class="form-control" name="respuesta_opinion" placeholder="Ingrese la respuesta a la opinión" value="{{$value->respuesta_opinion}}" required> 

              </div>

              <input type="hidden" name="id_opinion" value="{{ $value->id_opinion }}">


            <!-- Modal footer -->
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

  @endforeach

  <script>
  $("#responderOpinion").modal()
  </script>

  @endif

@endif

@if (Session::has("no-validacion"))

  <script>
      notie.alert({ type: 2, text: '¡Hay campos no válidos en la respuesta!', time: 10 })
 </script>

@endif

@if (Session::has("error"))

  <script>
      notie.alert({ type: 3, text: '¡Error en el gestor de respuestas!', time: 10 })
 </script>

@endif

@if (Session::has("ok-editar"))

  <script>
      notie.alert({ type: 1, text: '¡La respuesta ha sido enviada correctamente!', time: 10 })
 </script>

@endif

@endsection