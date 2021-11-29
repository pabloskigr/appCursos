<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use Illuminate\Support\Facades\DB;

class CursosController extends Controller
{
     
     public function crear(Request $req){

        $respuesta = ["status" => 1, "msg" => ""];

        $datos = $req->getContent();

        //VALIDAR EL JSON

        $datos = json_decode($datos); //Se interpreta como objeto. Se puede pasar un parámetro para que en su lugar lo devuelva como array.

        //VALIDAR LOS DATOS

        $Cursos = new Curso();

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


    public function lista(Request $req){

        $respuesta = ["status" => 1, "msg" => ""];
        $datos = $req->getContent();

        $datos = json_decode($datos);
        try{
            $Cursos = DB::table('Cursos');
        if($req->has('titulo')){
            $Cursos = Curso::withCount('video as cantidad')
            ->where('titulo','like','%'.$req->input('titulo').'%')
            ->get();
            $respuesta['datos'] = $Cursos;
        }else{
            $Cursos = Curso::withCount('video as cantidad')->get();
            $respuesta['datos'] = $Cursos;
        }
            
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }
        return response()->json($respuesta);
    }
}
