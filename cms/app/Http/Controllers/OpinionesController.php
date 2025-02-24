<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Opiniones;
use App\Blog;
use App\Administradores;

use Illuminate\Support\Facades\DB;
use App\Articulos;

class OpinionesController extends Controller
{
    public function index(){

    	 $join = DB::table('opiniones')
         ->join('users','opiniones.id_adm','=','users.id')
         ->join('articulos', 'opiniones.id_art', '=', 'articulos.id_articulo')
         ->select('opiniones.*','users.*','articulos.*')->get();   

        if(request()->ajax()){

            return datatables()->of($join)
            ->addColumn('aprobacion_opinion', function($data){
                $aprobacion = $data->aprobacion_opinion == 1 
                    ? '<button class="btn btn-success btn-sm toggle-aprobacion" data-id="'.$data->id_opinion.'" data-aprobacion="1">Aprobado</button>'
                    : '<button class="btn btn-danger btn-sm toggle-aprobacion" data-id="'.$data->id_opinion.'" data-aprobacion="0">Por Aprobar</button>';
                return $aprobacion;
            })
            ->addColumn('acciones', function($data){

                $acciones = '<div class="btn-group">
                            <a href="'.url()->current().'/'.$data->id_opinion.'" class="btn btn-warning btn-sm">
                              <i class="fas fa-pencil-alt text-white"></i>
                            </a>

                            <button class="btn btn-danger btn-sm eliminarRegistro" action="'.url()->current().'/'.$data->id_opinion.'" method="DELETE" token="'.csrf_token().'" pagina="opiniones"> 
                            <i class="fas fa-trash-alt"></i>
                            </button>

                          </div>';
               
                return $acciones;

            })
            ->rawColumns(['aprobacion_opinion','acciones'])
            ->make(true);

        }

		$blog = Blog::all();
		$administradores = Administradores::all();

		return view("paginas.opiniones", array("blog"=>$blog, "administradores"=>$administradores));

	}

      /*=============================================
    Mostrar un solo registro
    =============================================*/

    public function show($id){    


        $opiniones = Opiniones::where('id_opinion', $id)->get();
        $articulos = Articulos::all();
        $blog = Blog::all();
        $administradores = Administradores::all();

        if(count($opiniones) != 0){

            return view("paginas.opiniones", array("status"=>200, "opiniones"=>$opiniones, "articulos"=>$articulos, "blog"=>$blog, "administradores"=>$administradores));
        
        }else{
            
            return view("paginas.opiniones", array("status"=>404, "blog"=>$blog, "administradores"=>$administradores));
        
        }

    }

    
     /*=============================================
    Editar una opinion/Responder Opinion
    =============================================*/
    public function update($id, Request $request){

        // Recoger los datos

        $datos = array("id_opinion"=>$request->input("id_opinion"),
                        "respuesta_opinion"=>$request->input("respuesta_opinion"),); 

        $blog = Blog::all();
        // Validar los datos
        // https://laravel.com/docs/5.7/validation
        if(!empty($datos)){
            
           $validar = \Validator::make($datos,[

                "respuesta_opinion" => 'required|regex:/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',           
         
            ]);

            //Guardar articulo
            if($validar->fails()){
               
                return redirect("opiniones")->with("no-validacion", "");

            }else{


                $datos = array("id_opinion" => $datos["id_opinion"],
                                "respuesta_opinion" => $datos["respuesta_opinion"]
                                );

                $opiniones = Opiniones::where('id_opinion', $id)->update($datos); 

                return redirect("opiniones")->with("ok-editar", "");
            }

        }else{

             return redirect("opiniones")->with("error", "");

        }

    }
   

    // Método para cambiar el estado de aprobación de una opinión
    public function toggleAprobacion($id, Request $request){
        // Buscar la opinión por id_opinion usando el método where
        $opinion = Opiniones::where('id_opinion', $id)->first();
    
        // Verificar si la opinión existe
        if (!$opinion) {
            return response()->json([
                'success' => false,
                'message' => 'Opinión no encontrada.',
            ], 404);
        }
    
        // Cambiar el estado de aprobación
        $opinion->aprobacion_opinion = !$opinion->aprobacion_opinion; // Invertir el estado actual
    
        // Guardar los cambios especificando manualmente la columna id_opinion
        Opiniones::where('id_opinion', $id)->update([
            'aprobacion_opinion' => $opinion->aprobacion_opinion,
        ]);
    
        // Devolver una respuesta JSON
        return response()->json([
            'success' => true,
            'message' => 'Estado de aprobación actualizado correctamente.',
            'aprobacion' => $opinion->aprobacion_opinion,
        ]);
    }

    /*=============================================
    Eliminar un registro
    =============================================*/

    public function destroy($id, Request $request){

        $validar = Opiniones::where("id_opinion", $id)->get();
        
        if(!empty($validar)){

            $articulo = Opiniones::where("id_opinion",$validar[0]["id_opinion"])->delete();

            //Responder al AJAX de JS
            return "ok";
        
        }else{

            return redirect("opiniones")->with("no-borrar", "");   

        }

    }
   
}
