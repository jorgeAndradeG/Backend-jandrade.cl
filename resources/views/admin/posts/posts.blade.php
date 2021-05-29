<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@extends('adminlte::page')

@section('title', 'Lista de Posts')


@section('content')

<div style="text-align:right;">
    <a href="{{ action('App\Http\Controllers\Admin\PostController@create') }}" class="btn btn-success"><span style="color:white">Nuevo Post</span></a>
</div>

<br>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($posts as $post)
        <div class="col">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$post->titulo}}</h5>
                <p class="card-text">{{$post->subtitulo}}</p>
                <p><b>{{$post->fecha}}</b></p>
                <div class="row">
                    
                     <div class="col" style="text-align:left">
                        <a type="button" class="btn btn-success" href="{{ action('App\Http\Controllers\Admin\PostController@edit',$post->id)}} "><i class="far fa-edit" style="color:white"></i></a>
                    </div>
                    
                    @if($post->estado == 1)
                    <div class="col" style="text-align:right">
                        <button  type="button" class="btn btn-danger ventanaModal" data-toggle="modal" data-target="#myModal" data-id="{{$post->id}}">
                        <i class="far fa-eye-slash" style="color:white"></i>
                        </button>
                    </div> 
                    
                    @else
                    <div class="col" style="text-align:right">
                        <button  type="button" class="btn btn-danger ventanaModal2" data-toggle="modal" data-target="#myModal2" data-id="{{$post->id}}">
                          <i class="far fa-eye" style="color:white"></i>
                        </button>
                        
                    </div> 
                    @endif
                    
                </div>
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
        <h5 class="modal-title" id="exampleModalLabel">Deshabilitar Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="Post" action="{{ action('App\Http\Controllers\Admin\PostController@postOff') }}" role="form" enctype="multipart/form-data">
            @csrf
            
            <button type="submit" class="btn btn-danger" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-success">Si</button>

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
        <h5 class="modal-title" id="exampleModalLabel">Habilitar Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="Post" action="{{ action('App\Http\Controllers\Admin\PostController@postOn') }}" role="form" enctype="multipart/form-data">
            @csrf
            
            <button type="submit" class="btn btn-danger" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-success">Si</button>

            <input name="modalid" id="modalid" type="hidden" value="">

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
    $('#myModal').modal('show');
});
</script>


<script>
$(document).on("click",".ventanaModal2",function(){
    var Id = $(this).data('id');
    $(".modal-body #modalid").val(Id);
    $('#myModal2').modal('show');
});
</script>