<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $connection = 'mysql';

    public $timestamps = true;
	protected $table = 'post';	
	protected $fillable = ['id_categoria','fecha','contenido','titulo','subtitulo','estado'];
}
