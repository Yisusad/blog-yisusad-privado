<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Opiniones;

class OpinionesController extends Controller
{
    public function index(){

        $opiniones = Opiniones::all();
        return view('paginas.opiniones', array('opiniones' => $opiniones));

    }
}
