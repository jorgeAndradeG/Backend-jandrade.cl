<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@extends('adminlte::page')

@section('title', 'Lista de Posts')


@section('content')

    <div style="text-align:right;">
        <a  href="#" class="btn btn-success ventanaModal2" data-toggle="modal" data-target="#myModal"><span style="color:white">Nueva Categoría</span></a>

    </div>

    <br>


    <table class="table">
        <thead>
            <tr>
            <th scope="col">Nombre</th>
            <th scope="col1">Ver Posts</th>
            <th scope="col">Editar</th>

            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
                <tr>

                <td>{{$categoria->nombre}}</td>
                <td> 
                    <a  type="button" class="btn btn-success" href="{{ action('App\Http\Controllers\Admin\CategoriasController@show',$categoria->id)}} ">
                        <i class="fas fa-list" style="color:white"></i>
                    </a>
                </td>
                <td>
                <button  type="button" class="btn btn-success ventanaModal" data-toggle="modal" data-target="#modalEdit" data-id="{{$categoria->id}}">
                        <i class="fas fa-edit" style="color:white"></i>
                    </button>
                </tr>
            @endforeach
        </tbody>
</table>


@stop

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="Post" action="{{ action('App\Http\Controllers\Admin\CategoriasController@store') }}" role="form" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="exampleFormControlInput1" required>
            </div>  


            <div style="text-align:center">
                <button type="submit" class="btn btn-success">Crear</button>
            </div>

        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="Post" action="{{ action('App\Http\Controllers\Admin\CategoriasController@update',0) }}" role="form" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nuevo Nombre</label>
                <input type="text" class="form-control" name="nombre" id="exampleFormControlInput1" required>
            </div>  

            <input type="hidden" name="modalid" id="modalid">
            <div style="text-align:center">
                <button type="submit" class="btn btn-success">Crear</button>
            </div>

        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

<script>
$(document).on("click",".ventanaModal",function(){
    var Id = $(this).data('id');
    $(".modal-body #modalid").val(Id);
    $('#modalEdit').modal('show');
});
</script>