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
        $Cursos->email = $datos->email;
        $Cursos->descripcion = $datos->descripcion;
        $Cursos->activo = $datos->activo = 1;
        


        if(isset($datos->email))
            $Cursos->email = $datos->email;

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


    public function desactivar($id){

        $respuesta = ["status" => 1, "msg" => ""];

        //Buscar a la Cursos
        try{
            $Cursos = Cursos::find($id);


            if($Cursos->activo = 1){
                    $respuesta['msg'] = "Cursos desactivado";
                    $Cursos->activo = 0;
                    $Cursos->save();
            }else if ($Cursos->activo == 0){
                $respuesta["msg"] = "Cursos ya esta desactivadod";
            }else{
                $respuesta["msg"] = "Cursos ya esta desactivadod";
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
        //Buscar a la Cursos
        try{
            $Cursos = Cursos::find($id);

            if($Cursos ){

                //VALIDAR LOS DATOS

                if(isset($datos->titulo))
                    $Cursos->titulo = $datos->titulo;
                if(isset($datos->foto))
                    $Cursos->foto = $datos->foto;
                if(isset($datos->descripcion))
                    $Cursos->descripcion = $datos->descripcion;
                

                //Escribir en la base de datos
                    $Cursos->save();
                    $respuesta['msg'] = "Cursos actualizada.";
            }else{
                $respuesta["msg"] = "Cursos no encontrada";
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
            $personas = Cursos::all();
            $respuesta['datos'] = $personas;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }
        return response()->json($respuesta);
    }

    public function ver($id){
        $respuesta = ["status" => 1, "msg" => ""];


        //Buscar a la Cursos
        try{
            $Cursos = Cursos::find($id);
            $Cursos->makeVisible(['direccion','updated_at']);
            $respuesta['datos'] = $Cursos;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }
}
