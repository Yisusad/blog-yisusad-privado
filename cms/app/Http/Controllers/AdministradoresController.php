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

    public function update($id, Request $request){

        //Recoger datos del administrador

        $datos = array(
            'name' => $request->input("name"),
            'email' => $request->input("email"),
            'password_actual' => $request->input("password_actual"),
            'rol' => $request->input("rol"),
            'imagen_actual' => $request->input("imagen_actual")
        );

        $password = array("password"=>$request->input("password"));
		$foto = array("foto"=>$request->file("foto"));

        //Validar datos
        if(!empty($datos)){

            $validar = \Validator::make($datos,[

                'name' => "required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i",
                'email' => 'required|regex:/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/i'

            ]); 	 

           if($password["password"] != ""){

               $validarPassword = \Validator::make($password,[

                   "password" => "required|regex:/^[0-9a-zA-Z]+$/i"

               ]);

               if($validarPassword->fails()){

                   return redirect("/administradores")->with("no-validacion", "");

               }else{

                   $nuevaPassword = Hash::make($password['password']);

               }
                    
            }else{

                $nuevaPassword = $datos["password_actual"];
            }

            if($foto["foto"] != ""){

                  $validarFoto = \Validator::make($foto,[

                   "foto" => "required|image|mimes:jpg,jpeg,png|max:2000000"

               ]);

               if($validarFoto->fails()){

                   return redirect("/administradores")->with("no-validacion", "");

               }

            }

            if($validar->fails()){

                return redirect("/administradores")->with("no-validacion", "");

            }else{

                if($foto["foto"] != ""){

                    if(!empty($datos["imagen_actual"])){

                        if($datos["imagen_actual"] != "img/administradores/admin.png"){	

                            unlink($datos["imagen_actual"]);

                        } 			

                    } 
                    
                    $aleatorio = mt_rand(100,999);	

                    $ruta = "img/administradores/".$aleatorio.".".$foto["foto"]->guessExtension();

                    move_uploaded_file($foto["foto"], $ruta);

                }else{

                    $ruta =  $datos["imagen_actual"];
                }


                $datos = array("name" => $datos["name"],
                              "email" => $datos["email"],      
                               "password" => $nuevaPassword,
                               "rol" => $datos["rol"],
                               "foto" => $ruta);

                $administrador = Administradores::where('id', $id)->update($datos);

                return redirect("/administradores")->with("ok-editar", "");


            }

       }else{

           return redirect("/administradores")->with("error", "");

       }

    }
}