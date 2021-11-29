<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('videos', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('cursos_id');
            $table->string('titulo');
            $table->string('fotoPortada');
            $table->string('enlace');
            //$table->unsignedBigInteger('cursos_id')->references('id')->on('videos');
            $table->foreign('cursos_id')->references('id')->on('cursos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
