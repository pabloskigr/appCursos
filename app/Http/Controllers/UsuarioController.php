<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller


use Illuminate\Http\Request;
use App\Models\Usuario;

{
    //
    public function crear(Request $req){

        $respuesta = ["status" => 1, "msg" => ""];

        $datos = $req->getContent();

        //VALIDAR EL JSON

        $datos = json_decode($datos); //Se interpreta como objeto. Se puede pasar un parámetro para que en su lugar lo devuelva como array.

        //VALIDAR LOS DATOS

        $Usuario = new Usuario();

        $Usuario->nombre = $datos->nombre;
        $Usuario->foto = $datos->foto;
        $Usuario->email = $datos->email;
        $Usuario->contraseña = $datos->contraseña;


        if(isset($datos->email))
            $Usuario->email = $datos->email;

        //Escribir en la base de datos
        try{
            $Usuario->save();
            $respuesta['msg'] = "Usuario guardada con id ".$Usuario->id;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }


    public function borrar($id){

        $respuesta = ["status" => 1, "msg" => ""];

        //Buscar a la Usuario
        try{
            $Usuario = Usuario::find($id);

            if($Usuario){
                    $Usuario->delete();
                    $respuesta['msg'] = "Usuario borrada";
            }else{
                $respuesta["msg"] = "Usuario no encontrada";
                $respuesta["status"] = 0;
            }
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


        //Buscar a la Usuario
        try{
            $Usuario = Usuario::find($id);

            if($Usuario){

                //VALIDAR LOS DATOS

                if(isset($datos->nombre))
                    $Usuario->nombre = $datos->nombre;
                if(isset($datos->telefono))
                    $Usuario->telefono = $datos->telefono;
                if(isset($datos->direccion))
                    $Usuario->direccion = $datos->direccion;
                if(isset($datos->email))
                    $Usuario->email = $datos->email;

                //Escribir en la base de datos
                    $Usuario->save();
                    $respuesta['msg'] = "Usuario actualizada.";
            }else{
                $respuesta["msg"] = "Usuario no encontrada";
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
            $personas = Usuario::all();
            $respuesta['datos'] = $personas;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }
        return response()->json($respuesta);
    }

    public function ver($id){
        $respuesta = ["status" => 1, "msg" => ""];


        //Buscar a la Usuario
        try{
            $Usuario = Usuario::find($id);
            $Usuario->makeVisible(['direccion','updated_at']);
            $respuesta['datos'] = $Usuario;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }
}
