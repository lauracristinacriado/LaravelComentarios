@extends('layouts.app')

@section('content')
<div class="container" style="text-align: -webkit-center;">

@if(session("message"))
    <div class="alert alert-success">
        {{session("message")}}
    </div>
    @endif



    @if(count($comentarios) < 1)
    <div class="alert alert-info">
        No hay comentarios aun 
    </div>
    @endif
   
@foreach($comentarios as $comentario)
<div class="card" style=" width: 70%">
                <div class="card-header navbar">
                    
                    <div class="container-avatar-pub">
                        <img src="{{ route("users.avatar", ["filename" => $comentario->user->image]) }}" class="avatar" />
                    </div>
                   <div class="pub-imagen data-user">
                        <a href="">{{ $comentario->user->name. " ". $comentario->user->surname }}</a>
                        <span class="nickname">{{ " |@".$comentario->user->nick }} </span>
                        <span class="nickname">{{\FormatTime::LongTimeFilter($comentario->created_at)}}</span>
                        
                    </div>
                </div>

                <div class="card-body">
                  
                    <div class="descripcion">
                     
                        <h5 class="nickname">{{$comentario->content}}</h5>

                    </div>
                

                </div>
         
        </div>
               @endforeach







<form method="POST" action="{{ route('Comment.saveComentario') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                        <input class="field" type="hidden" value="{{$imagen}}" name="imagen"></input>
                            <label for="name" class="col-md-4 col-form-label text-md-right">Agregar un comentario...</label>

                            <div class="col-md-6">
                                <textarea class="form-control @error('content') is-invalid @enderror" name="content" required  autofocus></textarea>

                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Comentar
                                </button>
                            </div>
                        </div>
                    </form>
  
</div>
@endsection
