<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>


@extends('adminlte::page')

@section('title', 'Nuevo Post')


@section('content')
<!--
<style>
.main-sidebar { background-color: #fbfafa; !important }
</style>-->
@foreach($posts as $post)
<form action="{{ action('App\Http\Controllers\Admin\PostController@update',$post->id) }}" method="POST">
  @csrf
  @method('PATCH')
  <div class="row">
    @if(isset($msg))
      <p style="color:red">{{$msg}}</p>
    @endif
    <div class="col-1">
    </div>
        <div class="col-10">
        <div class="mb-3">
          <span class="mx-2">
            <b>¿Publicar?</b>
          </span>
        @if($post->estado == 0)
          <input class="bootstrap-switch" type="checkbox" name="estado" id="estado" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" checked />
        @else
          <input class="bootstrap-switch" type="checkbox" name="estado" id="estado" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
        @endif
        </div>

        <div class="mb-3">
        <label for="selectCategoria" class="form-label">Categoría</label>
        <select class="form-control" name="categoria" aria-label="Default select example">
          @foreach($categorias as $categoria)
            @if($post->id_categoria == $categoria->id)
              <option value="{{$categoria->id}}" selected>{{$categoria->nombre}}</option>
            @else
              <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
            @endif
            @endforeach
        </select>
        </div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Título</label>
      <input type="text" class="form-control" name="titulo" id="exampleFormControlInput1" value="{{$post->titulo}}" required>
    </div>
    <div class="mb-3">
      <label for="titulo" class="form-label">Subtítulo</label>
      <input type="text" class="form-control" name="subtitulo" id="subtitulo" value="{{$post->subtitulo}}" required>
    </div>
    <div class="mb-3">
      <label for="post" class="form-label">Post</label>
      <textarea class="ckeditor" name="post" id="post" rows="20" required>{!! $post->contenido !!}</textarea>
    </div>
    <div class="col-12" style="text-align:right;">
        <button class="btn btn-success" type="submit">Submit form</button>
      </div>
    </div>
    <div class="col-1"></div>


  </div>

</form>

@endforeach

@stop
