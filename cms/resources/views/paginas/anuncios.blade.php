@extends('plantilla')

@section('content')

<div class="content-wrapper" style="min-height: 247px;">

  <!-- Content Header (Page header) -->
  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 class="m-0 text-dark">Anuncios</h1>

        </div><!-- /.col -->

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="{{ url("/") }}">Inicio</a></li>

            <li class="breadcrumb-item active">Anuncios</li>

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

            <div class="card-header">

              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearAnuncio">Crear nuevo anuncio</button>

            </div>

            <div class="card-body">

          {{--@foreach ($anuncios as $element)
              {{$element}}
            @endforeach --}}

              <table class="table table-bordered table-striped dt-responsive" id="tablaAnuncios" width="100%">

                <thead>

                  <tr>

                    <th width="10px">#</th>
                    <th width="500px">Código</th>
                    <th>Página</th>
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
Crear Banner
======================================-->

<div class="modal" id="crearAnuncio">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form action="{{url('/')}}/anuncios" method="post" enctype="multipart/form-data">

        @csrf

        <div class="modal-header bg-info">
          <h4 class="modal-title">Crear Anuncio</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

           {{-- Página --}}
           
          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              <i class="fas fa-list-ul"></i>
            </div>

            <select class="form-control"  name="pagina_anuncio" required>

              <option value="" hidden>Elige Pagina</option>
             
              @foreach ($anuncio as $key => $value)

                <option value="{{$value->pagina_anuncio}}">{{$value->pagina_anuncio}}</option>              

              @endforeach

            </select>
            
          </div>
          
           {{-- Codigo Anuncio --}}
      
           <div class="input-group mb-3">
                    
            <div class="input-group-append input-group-text">               
              <i class="fas fa-pencil-alt"></i>
            </div>

            <input type="text" class="form-control" name="codigo_anuncio" placeholder="Ingrese el codigo html del anuncio" value="{{ $value->codigo_anuncio }}"  required>

          </div>

        </div>

        <!-- Modal footer -->
        <div class="modal-footer d-flex justify-content-between">

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


<!-- MODAL PARA EDITAR ANUNCIOS -->
@if (isset($status))
  @if ($status == 200)

    @foreach ($anuncio as $key => $value)
      <div class="modal" id="editarAnuncio">
  
        <div class="modal-dialog">
        
          <div class="modal-content">
      
            <form method="POST" action="{{url('/')}}/anuncios/{{$value->id_anuncio}}" enctype="multipart/form-data">
              @method('PUT')
              @csrf
            
              <div class="modal-header bg-info">
                
                <h4 class="modal-title">Editar Anuncio</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
      
              </div>
      
              <div class="modal-body">    
            
                {{-- Pagina Anuncio --}}
                    
                <div class="input-group mb-3">

                  <div class="input-group-append input-group-text">
                    <i class="fas fa-list-ul"></i>
                  </div>

                  <select class="form-control"  name="pagina_anuncio" required>
                
                    @foreach ($anuncio as $key => $value)

                      <option value="{{$value->pagina_anuncio}}">{{$value->pagina_anuncio}}</option>              
    
                    @endforeach

                  </select>
                  
                </div>  
                
              {{-- Descripción artículo --}}
                      
                  <div class="input-group mb-3">
            
                    <div class="input-group-append input-group-text">
                      <i class="fas fa-pencil-alt"></i>
                    </div>

                    <input type="text" class="form-control" name="codigo_anuncio" placeholder="Ingrese el codigo html del anuncio" value="{{$value->codigo_anuncio}}" maxlength="220" required> 

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
    @endforeach

    <script>
      $('#editarAnuncio').modal();
    </script>

  @endif

@endif

<!-- Notie Js Notificaciones inicio -->
@if (Session::has("ok-crear"))

<script>
    notie.alert({ type: 1, text: '¡El Anuncio ha sido creada correctamente!', time: 10 })
</script>

@endif

@if (Session::has("no-validacion"))

<script>
    notie.alert({ type: 2, text: '¡Hay campos no válidos en el formulario!', time: 10 })
</script>

@endif

@if (Session::has("error"))

  <script>
      notie.alert({ type: 3, text: '¡Error en el gestor de Anuncios!', time: 10 })
 </script>

@endif

@if (Session::has("ok-editar"))

  <script>
      notie.alert({ type: 1, text: '¡El Anuncio ha sido actualizado correctamente!', time: 10 })
 </script>
@endif

@if (Session::has("no-borrar"))

  <script>
      notie.alert({ type: 1, text: '¡Error al borrar el Anuncio', time: 10 })
 </script>

@endif
<!-- Notie Js Notificaciones fin -->

@endsection