<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anuncios;
use App\Blog;
use App\Administradores;

class AnunciosController extends Controller
{
    public function index(){

		 if(request()->ajax()){

            return datatables()->of(Anuncios::all())
             ->addColumn('codigo_anuncio', function($data){

                $codigo_anuncio = '<div class="card collapsed-card">

							        <div class="card-header">

							          <h3 class="card-title">Ver Anuncio</h3>

							          <div class="card-tools">

							            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
							              <i class="fas fa-minus"></i>
							            </button>
							           
							          </div>

							        </div>

							        <div class="card-body">'.$data->codigo_anuncio.'</div>

							      </div>';
                
                return $codigo_anuncio;

            })
            ->addColumn('acciones', function($data){

                $acciones = '<div class="btn-group">
                            <a href="'.url()->current().'/'.$data->id_anuncio.'" class="btn btn-warning btn-sm">
                              <i class="fas fa-pencil-alt text-white"></i>
                            </a>
                         
                            <button class="btn btn-danger btn-sm eliminarRegistro" action="'.url()->current().'/'.$data->id_anuncio.'" method="DELETE" token="'.csrf_token().'" pagina="anuncios"> 
                            <i class="fas fa-trash-alt"></i>
                            </button>

                          </div>';
               
                return $acciones;

            })
            ->rawColumns(['codigo_anuncio','acciones'])
            ->make(true);

        };

		$blog = Blog::all();
		$administradores = Administradores::all();
    $anuncio = Anuncios::all()->unique('pagina_anuncio');

		return view("paginas.anuncios", array("blog"=>$blog, "administradores"=>$administradores, "anuncio"=>$anuncio));

	}

    //Crear nuevo registro en la tabla Anuncios

    public function store(Request $request){

        //Recoger datos
        $datos = array('pagina_anuncio' => $request->input("pagina_anuncio"),
                       'codigo_anuncio' => $request->input("codigo_anuncio"));

        //Validar datos
        if(!empty($datos)){

            $validar = \Validator::make($datos, [
                "codigo_anuncio" => 'required|regex:/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
            ]);

      
            if($validar->fails()){
                var_dump("Putas");
                exit();
                return redirect("/anuncios")->with("no validacion", "");
            }else{

                //Guardar datos en la base de datos
                $anuncio = new Anuncios();
                $anuncio->pagina_anuncio = $datos["pagina_anuncio"];
                $anuncio->codigo_anuncio = $datos["codigo_anuncio"];

                $anuncio->save();
                
                return redirect("/anuncios")->with("ok-crear", "");
            }

        }else{

            return redirect("/anuncios")->with("error", "");
        }
    }

    
    //Editar un registro en la tabla anuncios
    public function show($id)
    {

        $anuncio = Anuncios::where("id_anuncio", $id)->get();
        $blog = Blog::all();
        $administradores = Administradores::all();

        if(count($anuncio) != 0){

            return view("paginas.anuncios", array("status"=>200, "anuncio"=>$anuncio, "blog"=>$blog, "administradores"=>$administradores)); 
        }

        else{
            
            return view("paginas.anuncios", array("status"=>404, "blog"=>$blog, "administradores"=>$administradores));

        }
    }

      //Actualizar un registro en la tabla Anuncios
      public function update($id, Request $request)
      {
          //Recogemos los datos de la categoria
          //Recoger datos
          $datos = array('pagina_anuncio' => $request->input("pagina_anuncio"),
                          'codigo_anuncio' => $request->input("codigo_anuncio"));
  
          //Validar datos
  
          if(!empty($datos)){
  
              $validar = \Validator::make($datos, [
                "codigo_anuncio" => 'required|regex:/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
              ]);
  
              if($validar->fails()){
  
                  return redirect("/anuncios")->with("no-validacion", "");
  
              }else{
                  //Actualizar datos en la base de datos
  
                  $datos = array("pagina_anuncio" => $datos["pagina_anuncio"],
                                 "codigo_anuncio" => $datos["codigo_anuncio"]
                              );
                  //Actualizar datos en la base de datos
                  $anuncio = Anuncios::where("id_anuncio", $id)->update($datos);
  
                  return redirect("/anuncios")->with("ok-editar", "");
  
              }
  
          }else{
  
              return redirect("/anuncios")->with("error", "");
  
          }
  
  
      }


      // Eliminar un registro en la tabla categorias
      public function destroy($id, Request $request){

        $paraEliminar =Anuncios::where("id_anuncio", $id)->get();
        
        if(!empty($paraEliminar)){
          //Aqui se borra el anuncio
          $anuncio = Anuncios::where("id_anuncio", $paraEliminar[0]["id_anuncio"])->delete();
          //Responder al AJAX de JS para Sweet Alert
          return "ok";
        
        }else{

          return redirect("/anuncios")->with("no-borrar", "");
        
        }

      }
}
