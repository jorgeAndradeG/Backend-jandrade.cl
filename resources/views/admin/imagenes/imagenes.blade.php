<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@extends('adminlte::page')

@section('title', 'Lista de Posts')


@section('content')

<div style="text-align:right;">
<button  type="button" class="btn btn-success ventanaModal" data-toggle="modal" data-target="#myModal">
    <span style="color:white">Nueva Imagen</span>
</button>
</div>
    @if(isset($msg))
        <p style="color:red">
        {{$msg}}
        </p>
    @endif
<br>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($imagenes as $imagen)
        <div class="col">
            <div class="card">
            <img class="card-img" src="/{{$imagen->url_imagen}}" alt="/{{$imagen->url_imagen}}">
                <p class="card-text">/{{$imagen->url_imagen}}</p>
 
                    <div style="text-align:center">
                        <button  type="button" class="btn btn-danger ventanaModal2" data-toggle="modal" data-target="#myModal2" data-id="{{$imagen->id}}">
 
                          <i class="fa fa-trash" style="color:white"></i>
                        </button>
                    </div> 

            </div>
        </div>
    @endforeach
</div>

@stop


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva Imagen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="Post" action="{{ action('App\Http\Controllers\Admin\ImagenesController@store') }}" role="form" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <input type="file" class="form-control" id="customFile" name="file" required/>
            </div>  
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="exampleFormControlInput1" required>
            </div>  

            
            <div style="text-align:center">
                <button type="submit" class="btn btn-primary">Cargar</button>
            </div>
            

            <input name="modalid" id="modalid" type="hidden" value="">

        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Eliminar esta Imagen?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="Post" action="{{ action('App\Http\Controllers\Admin\ImagenesController@eliminar') }}" role="form" enctype="multipart/form-data">
            @csrf
            <div class="row"> 
                <div clas="col" style="text-align:left">
                    <button type="submit" class="btn btn-success">Si</button>
                </div>
                <div class="col" style="text-align:right">
                    <button type="submit" class="btn btn-danger" data-dismiss="modal">No</button>
                </div>
            </div>
            <input name="modalid" id="modalid" type="hidden" value="">

        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>



<script>
$(document).on("click",".ventanaModal2",function(){
    var Id = $(this).data('id');
    $(".modal-body #modalid").val(Id);
    $('#myModal2').modal('show');
});
</script>+