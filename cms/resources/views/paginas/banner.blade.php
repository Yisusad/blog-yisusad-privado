@extends('plantilla')

@section('content')

<div class="content-wrapper" style="min-height: 247px;">

  <!-- Content Header (Page header) -->
  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 class="m-0 text-dark">Banner</h1>

        </div><!-- /.col -->

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="{{ url("/") }}">Inicio</a></li>

            <li class="breadcrumb-item active">Banner</li>

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

               <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearBanner">Crear nuevo banner</button>


            </div>

            <div class="card-body">

        {{--      @foreach ($banner as $element)
                  {{$element}}
                @endforeach
         --}}
              <table class="table table-bordered table-striped dt-responsive" id="tablaBanner" width="100%">

                <thead>

                  <tr>

                    <th width="10px">#</th>
                    <th width="500px">Banner</th>
                    <th>Página</th>
                    <th>Título</th>
                    <th>Descripción</th>
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

<div class="modal" id="crearBanner">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form action="{{url('/')}}/banner" method="post" enctype="multipart/form-data">

        @csrf

        <div class="modal-header bg-info">
          <h4 class="modal-title">Crear Banner</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

           {{-- Página --}}
           
          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              <i class="fas fa-list-ul"></i>
            </div>

            <select class="form-control"  name="pagina_banner" required>

              <option value="" hidden>Elige Pagina</option>
             
              @foreach ($banner as $key => $value)

                <option value="{{$value->pagina_banner}}">{{$value->pagina_banner}}</option>              

              @endforeach

            </select>
            
          </div>
        
          {{-- Título banner --}}
                    
          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              <i class="fas fa-list-ul"></i>
            </div>

            <input type="text" class="form-control" name="titulo_banner" placeholder="Ingrese el titulo del banner" value="{{old("titulo_banner")}}"> 

          </div> 

          {{-- Descripción banner --}}
                  
          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-pencil-alt"></i>
            </div>

            <input type="text" class="form-control" name="descripcion_banner" placeholder="Ingrese la descripción del banner" value="{{old("descripcion_banner")}}" maxlength="220"> 

          </div> 

          <hr class="pb-2">

          <div class="form-group my-2 text-center">

            <div class="btn btn-default btn-file">

                <i class="fas fa-paperclip"></i> Adjuntar Imagen del banner

                <input type="file" name="img_banner" required>
               
            </div>

            <img class="previsualizarImg_img_banner img-fluid py-2">

             <p class="help-block small">Dimensiones: 680px * 400px | Peso Max. 2MB | Formato: JPG o PNG</p>

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

<!-- MODAL PARA EDITAR Categorías -->
@if (isset($status))
  @if ($status == 200)

    @foreach ($banner as $key => $value)
      <div class="modal" id="editarBanner">
  
        <div class="modal-dialog">
        
          <div class="modal-content">
      
            <form method="POST" action="{{url('/')}}/banner/{{$value->id_banner}}" enctype="multipart/form-data">
              @method('PUT')
              @csrf
            
              <div class="modal-header bg-info">
                
                <h4 class="modal-title">Editar Banner</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
      
              </div>
      
              <div class="modal-body">

                
               {{-- Pagina banner --}}
               
              <div class="input-group mb-3">

                <div class="input-group-append input-group-text">
                  <i class="fas fa-list-ul"></i>
                </div>

                <select class="form-control"  name="pagina_banner" required>
               
                  @foreach ($banner as $key => $value)

                    <option value="{{$value->pagina_banner}}">{{$value->pagina_banner}}</option>              
  
                  @endforeach


                </select>
                
              </div>
      
                  {{-- Titulo de banner --}}
      
                  <div class="input-group mb-3">
                    
                    <div class="input-group-append input-group-text">               
                      <i class="fas fa-list-ul"></i>
                    </div>
      
                    <input type="text" class="form-control" name="titulo_banner" placeholder="Ingrese título del banner" value="{{ $value->titulo_banner }}">
      
                  </div>
      
                  {{-- Descripción de banner --}}
      
                  <div class="input-group mb-3">
                    
                    <div class="input-group-append input-group-text">               
                      <i class="fas fa-pencil-alt"></i>
                    </div>
      
                    <input type="text" class="form-control" name="descripcion_banner" placeholder="Ingrese descripción del banner" value="{{ $value->descripcion_banner }}">
      
                  </div>

  
      
                  <hr class="pb-2">
      
                  {{-- Imagen de Banner --}}
      
                  <div class="form-group my-2 text-center">
                    
                    <div class="btn btn-default btn-file">               
                      <i class="fas fa-paperclip"></i>Agregar Imagen
                      <input type="file" name="img_banner">
                    </div>
                    
                    <img src="{{url('/')}}/{{$value->img_banner}}" class="previsualizarImg_img_banner img-fluid py-2">

                    <input type="hidden" value="{{$value->img_banner}}" name="imagen_actual">

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
    @endforeach

    <script>
      $('#editarBanner').modal();
    </script>

  @endif

@endif


<!-- Notie Js Notificaciones comienzo -->
@if (Session::has("ok-crear"))

<script>
    notie.alert({ type: 1, text: '¡El banner ha sido creada correctamente!', time: 10 })
</script>

@endif

@if (Session::has("no-validacion"))

<script>
    notie.alert({ type: 2, text: '¡Hay campos no válidos en el formulario!', time: 10 })
</script>

@endif

@if (Session::has("error"))

  <script>
      notie.alert({ type: 3, text: '¡Error en el gestor de banners!', time: 10 })
 </script>

@endif

@if (Session::has("ok-editar"))

  <script>
      notie.alert({ type: 1, text: '¡El banner ha sido actualizado correctamente!', time: 10 })
 </script>
@endif

@if (Session::has("no-borrar"))

  <script>
      notie.alert({ type: 1, text: '¡Error al borrar el banner', time: 10 })
 </script>

@endif
<!-- Notie Js Notificaciones fin -->

@endsection