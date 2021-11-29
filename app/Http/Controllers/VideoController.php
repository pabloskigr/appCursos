<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    //
    public function crear(Request $req){

        $respuesta = ["status" => 1, "msg" => ""];

        $datos = $req->getContent();

        //VALIDAR EL JSON

        $datos = json_decode($datos); //Se interpreta como objeto. Se puede pasar un parámetro para que en su lugar lo devuelva como array.

        //VALIDAR LOS DATOS

        $Videos = new Video();

        $Videos->titulo = $datos->titulo;
        $Videos->fotoPortada = $datos->fotoPortada;
        $Videos->enlace = $datos->enlace;
        $Videos->cursos_id = $datos->cursos_id;
        

        if(isset($datos->email))
            $Videos->email = $datos->email;

        //Escribir en la base de datos
        try{
            $Videos->save();
            $respuesta['msg'] = "Videos guardada con id ".$Videos->id;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }

    public function listar(){

        $respuesta = ["status" => 1, "msg" => ""];
        try{
            $personas = Video::all();
            $respuesta['datos'] = $personas;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }
        return response()->json($respuesta);
    }

    public function ver($id){
        $respuesta = ["status" => 1, "msg" => ""];


        //Buscar a la Videos
        try{
            $Videos = Video::find($id);
            $Videos->makeVisible(['direccion','updated_at']);
            $respuesta['datos'] = $Videos;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }
}
