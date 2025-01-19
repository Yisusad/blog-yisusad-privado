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
}
