<?php

namespace App\Http\Controllers\Admin;

use App\Models\Imagen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class ImagenesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imagenes = Imagen::all();
        return view('admin.imagenes.imagenes',compact('imagenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //PARA SUBIR LAS IMÁGENES
         $postData = $request->only('file');
         $file = $postData['file'];
         $nombre = $request['nombre'];
         $nombre = str_replace(' ', '_', $nombre); // Delete all spaces.
         $nombre = preg_replace('/[^A-Za-z0-9\-]/', '', $nombre); // Removes special chars.
         $fileArray = array('image' => $file);
     
         // Tell the validator that this file should be an image
         $rules = array(
           'image' => 'mimes:jpeg,jpg,png,gif|required' 
         );
     
         // Now pass the input and rules into the validator
         $validator = Validator::make($fileArray, $rules);
     
         // Check to see if validation fails or passes
         if ($validator->fails())
         {
             //CUANDO NO ES IMAGEN
             $imagenes = Imagen::all();
             return view('admin.imagenes.imagenes', ['msg'=> 'Ingrese una imagen.'], compact('imagenes'));
         } else
         {
             // Store the File Now
             // read image from temporary file
             $aa = exif_imagetype($file);
             $tipo = image_type_to_mime_type($aa);
             if($tipo == "image/gif"){
                 $tipo = ".gif";
             }
             elseif($tipo == "image/jpeg"){
                 $tipo = ".jpg";
             }
             elseif($tipo == "image/png"){
                 $tipo = ".png";
             }

             $size = $request['tipo'];
                 $fecha = getdate();
                 $fechaimg = strval($fecha["year"]) . strval($fecha["mon"]) . strval($fecha["mday"]) . strval($fecha["hours"]) . strval($fecha["minutes"]) . "_";

                 Image::make($file)->resize(800,600)->save('img/' . $fechaimg . $nombre . $tipo);
                
                 Imagen::create([
                     'url_imagen' => 'img/' . $fechaimg . $nombre . $tipo,
                 ]);
             
             return redirect('/imagenes');
         };
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
        //
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
        //
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

    public function eliminar(Request $request)
    {
        if($request['modalid'] == ""){
            return redirect('/imagenes');
        }
        $foto = Imagen::findOrFail($request['modalid']);
        File::delete($foto->url_imagen);
        $eliminar = Imagen::destroy($request['modalid']);
        
        return redirect('/imagenes');
    }
}
