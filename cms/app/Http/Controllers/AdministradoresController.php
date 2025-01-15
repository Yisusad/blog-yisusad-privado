<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Administradores;
use App\Blog;

class AdministradoresController extends Controller
{

    // Función que devuelve la vista de la página de administradores

    public function index(){

        $administradores = Administradores::all();
        $blog = Blog::all();
        return view('paginas.administradores', array('administradores' => $administradores, 'blog' => $blog));

    }

    // Función que devuelve la vista de la página de administradores con un administrador en concreto

    public function show($id){

        $administradores = Administradores::where("id", $id)->get();
        $blog = Blog::all();

        if(count($administradores) != 0){
            return view('paginas.administradores', array('status'=>200,'administradores' => $administradores, 'blog' => $blog));
        }else{
            return view('paginas.administradores', array('status'=>404, 'blog' => $blog));
        }
    }

}