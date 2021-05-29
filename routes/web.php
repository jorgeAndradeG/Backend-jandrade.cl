<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoriasController;
use App\Http\Controllers\Admin\ImagenesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/admin',function() {
    return view('dashboard');
});

Route::resource('/post', PostController::class);
Route::post('/post/postOff/', [PostController::class,'postOff']);
Route::post('/post/postOn/', [PostController::class,'postOn']);

Route::resource('/categorias', CategoriasController::class);

Route::resource('/imagenes', ImagenesController::class);
Route::post('/imagenes/eliminar/', [ImagenesController::class,'eliminar']);




