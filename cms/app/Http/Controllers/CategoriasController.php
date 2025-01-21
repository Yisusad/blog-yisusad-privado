<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;
use App\Blog;
use App\Administradores;

class CategoriasController extends Controller
{
    public function index(){

        if(request()->ajax()){

            return datatables()->of(Categorias::all())
            ->addColumn('p_claves_categoria', function($data){
                
                $tags = json_decode($data->p_claves_categoria, true);

                $p_claves_categoria = '<h5>';

                foreach($tags as $key => $value){
                    $p_claves_categoria .= '<span class="badge badge-secondary mx-1">'.$value.'</span> ';
                }

                $p_claves_categoria .= '</h5>';

                return $p_claves_categoria;

            })
            ->addColumn('acciones', function($data){

                $acciones = '<div class="btn-group">

                <a href="'.url()->current().'/'.$data->id_categoria.'" class="btn btn-warning btn-sm">
                    <i class="fas fa-pencil-alt text-white"></i>
                </a>

                <button class="btn btn-danger btn-sm eliminarRegistro" action="'.url()->current().'/'.$data->id_categoria.'" method="DELETE" pagina="administradores" token="'.csrf_token().'" style="margin-left: 5px;">
                    <i class="fas fa-trash-alt text-white"></i>
                </button>
                               
                </div>';

                return $acciones;
            })
            ->rawColumns(['p_claves_categoria', 'acciones'])
            ->make(true);

        }

        // $categorias = Categorias::all();
        $blog = Blog::all();
        $administradores = Administradores::all();
        return view('paginas.categorias', array('blog' => $blog, 'administradores' => $administradores));

    }

    //Crear nuevo registro en la tabla categorias

    public function store(Request $request)
    {

        $datos = array('titulo_categoria' => $request->input("titulo_categoria"),
                       'descripcion_categoria' => $request->input("descripcion_categoria"),
                       'p_claves_categoria' => $request->input("p_claves_categoria"),
                       'ruta_categoria' => $request->input("ruta_categoria"),
                       'imagen_temporal' => $request->file("img_categoria"));
        //Validar datos

        if(!empty($datos)){

            $validar = \Validator::make($datos, [
                
    			"titulo_categoria"=> "required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i",
    			"descripcion_categoria"=> "required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i",
    			"p_claves_categoria"=> 'required|regex:/^[,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
    			"ruta_categoria"=> "required|regex:/^[a-z0-9-]+$/i",
    			"imagen_temporal"=> "required|image|mimes:jpg,jpeg,png|max:2000000"

            ]);

            //Guardar categoria
            //Revisa si imagen_temporal no esta vacio y si la validacion es correcta
            if(!$datos["imagen_temporal"] || $validar->fails()){

                return redirect("categorias")->with("no validacion", "");
            }else{

                //crear ruta para la imagen temporal
                $aleatorio = uniqid();
                $ruta = "img/categorias/" . $aleatorio . "." . $datos["imagen_temporal"]->guessExtension();

                //Redimensionar imagen

                list($ancho, $alto) = getimagesize($datos["imagen_temporal"]);

                $nuevoAncho = 1024;
                $nuevoAlto = 576;

                if ($datos["imagen_temporal"]->guessExtension() == "jpeg") {

                    $origen = imagecreatefromjpeg($datos["imagen_temporal"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagejpeg($destino, $ruta);
                }

                if ($datos["imagen_temporal"]->guessExtension() == "png") {

                    $origen = imagecreatefrompng($datos["imagen_temporal"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagealphablending($destino, FALSE);
                    imagesavealpha($destino, TRUE);
                    imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagepng($destino, $ruta);
                }

                //Guardar datos en la base de datos
                $categoria = new Categorias();
                $categoria->titulo_categoria = $datos["titulo_categoria"];
                $categoria->descripcion_categoria = $datos["descripcion_categoria"];
                $categoria->p_claves_categoria = json_encode(explode(",", $datos["p_claves_categoria"]));
                $categoria->ruta_categoria = $datos["ruta_categoria"];
                $categoria->img_categoria = $ruta;

                $categoria->save();

                return redirect("/categorias")->with("ok-crear", "");
            }

        }else{

            return redirect("/categorias")->with("error", "");
        }
    }
}

