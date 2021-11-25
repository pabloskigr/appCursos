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

        $Videos = new Videos();

        $Videos->titulo = $datos->titulo;
        $Videos->fotoPortada = $datos->fotoPortada;
        $Videos->email = $datos->email;
        $Videos->enlace = $datos->enlace;
        $Videos->activo = $datos->activo = 1;
        


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


    public function desactivar($id){

        $respuesta = ["status" => 1, "msg" => ""];

        //Buscar a la Videos
        try{
            $Videos = Videos::find($id);


            if($Videos->activo = 1){
                    $respuesta['msg'] = "Videos desactivado";
                    $Videos->activo = 0;
                    $Videos->save();
            }else if ($Videos->activo == 0){
                $respuesta["msg"] = "Videos ya esta desactivadod";
            }else{
                $respuesta["msg"] = "Videos ya esta desactivadod";
                $respuesta["status"] = 0Videos            }
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }


    public function editar(Request $req,$id){

        $respuesta = ["status" => 1, "msg" => ""];

        $datos = $req->getContent();

        //VALIDAR EL JSON

        $datos = json_decode($datos); //Se interpreta como objeto. Se puede pasar un parámetro para que en su lugar lo devuelva como array.
        //Buscar a la Videos
        try{
            $Videos = Videos::find($id);

            if($Videos ){

                //VALIDAR LOS DATOS

                if(isset($datos->titulo))
                    $Videos->titulo = $datos->titulo;
                if(isset($datos->fotoPortada))
                    $Videos->fotoPortada = $datos->fotoPortada;
                if(isset($datos->enlace))
                    $Videos->enlace = $datos->enlace;
                

                //Escribir en la base de datos
                    $Videos->save();
                    $respuesta['msg'] = "Videos actualizada.";
            }else{
                $respuesta["msg"] = "Videos no encontrada";
                $respuesta["status"] = 0;
            }
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }

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
