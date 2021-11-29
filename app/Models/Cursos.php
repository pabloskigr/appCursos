<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cursos;

class Cursos extends Model
{
    use HasFactory;
    protected $hidden = ['id','descripcion','created_at','updated_at'];

    
}
