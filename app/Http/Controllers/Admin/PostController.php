<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.posts',compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.posts.create-post',compact('categorias'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request['estado'] == "on"){
            $estado = 1;
        }
        else{
            $estado = 0;
        }
        $hoy = getdate();
        $fecha = $hoy['year'] . '-' . $hoy['mon'] . '-' . $hoy['mday'];

       Post::create([
           'titulo' => $request['titulo'],
           'subtitulo' => $request['subtitulo'],
           'contenido' => $request['post'],
           'fecha' => $fecha,
           'estado' => $estado,
           'id_categoria' => $request['categoria'],
       ]);

       return redirect('/post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Post::Where('id',$id)->get();
        $categorias = Categoria::all();
        return view('admin.posts.edit-post',compact('posts','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request['estado'] == "on"){
            $estado = 1;
        }
        else{
            $estado = 0;
        }

        $post = Post::findOrFail($id);
        $post->titulo = $request['titulo'];
        $post->subtitulo = $request['subtitulo'];
        $post->contenido = $request['post'];
        $post->estado = $estado;
        $post->id_categoria = $request['categoria'];
        $post->save();

        return redirect('/post');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function postOff(Request $request)
    {
      
        $post = Post::findOrFail($request['modalid']);
        $post->estado = 0;
        $post->save();
       return redirect('/post');
        
    }

    public function postOn(Request $request)
    {
        $post = Post::findOrFail($request['modalid']);
        $post->estado = 1;
        $post->save();
        return redirect('/post');
    }
}
