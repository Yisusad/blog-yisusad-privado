<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
    public function index(){

        $blog = Blog::all();
        return view('paginas.blog', array('blog' => $blog));

    }
}
