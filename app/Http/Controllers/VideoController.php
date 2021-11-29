<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videos;

class VideoController extends Controller
{
    //
    public function crear(Request $req){

        $respuesta = ["status" => 1, "msg" => ""];

        $datos = $req->getContent();

        //VALIDAR EL JSON

        $datos = json_decode($datos); //Se interpreta como objeto. Se puede pasar un parámetro para que en su lugar lo devuelva como array.

        //VALIDAR LOS DATOS

        $Videos = new Videos();

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
    // public function desactivar($id){

    //     $respuesta = ["status" => 1, "msg" => ""];

    //     //Buscar a la Usuario
    //     try{
    //         $Usuario = Usuario::find($id);


    //         if($Usuario->activo = 1){
    //                 $respuesta['msg'] = "Usuario desactivado";
    //                 $Usuario->activo = 0;
    //                 $Usuario->save();
    //         }else if ($Usuario->activo == 0){
    //             $respuesta["msg"] = "Usuario ya esta desactivadod";
    //         }else{
    //             $respuesta["msg"] = "Usuario ya esta desactivadod";
    //             $respuesta["status"] = 0;
    //         }
    //     }catch(\Exception $e){
    //         $respuesta['status'] = 0;
    //         $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
    //     }

    //     return response()->json($respuesta);
    // }

    public function listar(){

        $respuesta = ["status" => 1, "msg" => ""];
        try{
            $personas = Videos::all();
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
            $Videos = Videos::find($id);
            $Videos->makeVisible(['direccion','updated_at']);
            $respuesta['datos'] = $Videos;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }
}
