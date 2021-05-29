<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
@extends('adminlte::page')

@section('title', 'Nuevo Post')


@section('content')
<!--
<style>
.main-sidebar { background-color: #fbfafa; !important }
</style>-->
<form action="{{ action('App\Http\Controllers\Admin\PostController@store') }}" method="POST">
  @csrf
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
          <input class="bootstrap-switch" type="checkbox" name="estado" id="estado" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" />
        </div>

        <div class="mb-3">
        <label for="selectCategoria" class="form-label">Categoría</label>
        <select class="form-control" name="categoria" aria-label="Default select example">
          @foreach($categorias as $categoria)
            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
            @endforeach
        </select>
        </div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Título</label>
      <input type="text" class="form-control" name="titulo" id="exampleFormControlInput1" required>
    </div>
    <div class="mb-3">
      <label for="titulo" class="form-label">Subtítulo</label>
      <input type="text" class="form-control" name="subtitulo" id="subtitulo" required>
    </div>
    <div class="mb-3">
      <label for="post" class="form-label">Post</label>
      <textarea class="ckeditor" name="post" id="post" rows="20" required></textarea>
    </div>
    <div class="col-12" style="text-align:right;">
        <button class="btn btn-success" type="submit">Submit form</button>
      </div>
    </div>
    <div class="col-1"></div>


  </div>

</form>



@stop
