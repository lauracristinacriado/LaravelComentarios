@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($images as $image)
            <div class="card">
                <div class="card-header navbar">
                    
                    <div class="container-avatar-pub">
                        <img src="{{ route("users.avatar", ["filename" => $image->user->image]) }}" class="avatar" />
                    </div>
                   <div class="pub-imagen data-user">
                        <a href="">{{ $image->user->name. " ". $image->user->surname }}</a>
                        <span class="nickname">{{ " |@".$image->user->nick }}</span>
                        
                    </div>
                </div>

                <div class="card-body">
                    <div class="image-container">
                        <img src="{{ route("image.getImage", ["filename" => $image->image_path]) }}"   />
                    </div>
                    <div class="descripcion">
                        <div class="nickname">
                            {{ " |@".$image->user->nick }}
                        </div>
                        <p class="nickname">{{"Creada: ".\FormatTime::LongTimeFilter($image->created_at)}}</p>

                    </div>
                    <div class="comments">
                        <a href="{{route("Comment.getComentarios", ["id" => $image->id])}}" class="btn btn-info btn-sm">Comentarios {{ count($image->comments) }} </a>
                        
                    </div>

                </div>
         
        </div>
               @endforeach
    </div>
</div>    
@endsection
