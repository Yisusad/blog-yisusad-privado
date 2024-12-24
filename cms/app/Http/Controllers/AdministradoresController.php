<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Administradores;

class AdministradoresController extends Controller
{
    public function index(){

        $administradores = Administradores::all();
        return view('paginas.administradores', array('administradores' => $administradores));

    }
}
