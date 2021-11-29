<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cursos;

class CursosController extends Controller
{
     
     public function crear(Request $req){

        $respuesta = ["status" => 1, "msg" => ""];

        $datos = $req->getContent();

        //VALIDAR EL JSON

        $datos = json_decode($datos); //Se interpreta como objeto. Se puede pasar un parámetro para que en su lugar lo devuelva como array.

        //VALIDAR LOS DATOS

        $Cursos = new Cursos();

        $Cursos->titulo = $datos->titulo;
        $Cursos->foto = $datos->foto;
        $Cursos->descripcion = $datos->descripcion;
        

        //Escribir en la base de datos
        try{
            $Cursos->save();
            $respuesta['msg'] = "Cursos guardada con id ".$Cursos->id;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }


    public function listar(){

        $respuesta = ["status" => 1, "msg" => ""];
        try{
            $personas = Cursos::all();
            $respuesta['datos'] = $personas;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }
        return response()->json($respuesta);
    }
}
