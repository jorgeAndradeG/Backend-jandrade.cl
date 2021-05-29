<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $connection = 'mysql';

    public $timestamps = true;
	protected $table = 'categoria';	
	protected $fillable = ['nombre'];
}
