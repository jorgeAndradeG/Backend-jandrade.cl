<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    public $timestamps = true;
	protected $table = 'imagen';	
	protected $fillable = ['url_imagen'];
}
