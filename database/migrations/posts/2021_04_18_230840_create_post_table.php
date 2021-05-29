<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('id_categoria');
            $table->date('fecha');
            $table->longText('contenido');
            $table->string('titulo');
            $table->string('subtitulo');
            $table->integer('estado');
            $table->foreign('id_categoria')->references('id')->on('categoria')->onDelete('cascade');
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
        Schema::dropIfExists('post');
    }
}
