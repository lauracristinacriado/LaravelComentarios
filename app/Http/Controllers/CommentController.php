<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Http\Response;

class CommentController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }


    public function getComentarios($id){

        $comentarios = Comment::where('image_id', $id)->orderBy("created_at", "desc")->paginate(5);
        return view('images.comentarios', ["comentarios" => $comentarios, "imagen" => $id] );
    }



    public function saveComentario(Request $request){
        $comentario = new Comment;
        $user_id = \Auth::user()->id;
        $image_id = $request->input("imagen");
        $content = $request->input("content");
        
        $validate = $this->validate($request, 
               [ "content" => "string|required",
        ]);
        
   
        $comentario->user_id = $user_id;
        $comentario->image_id = $image_id;
        $comentario->content = $content;
    

        $comentario->save();
        $comentarios = Comment::where('image_id', $image_id)->orderBy("created_at", "asc")->paginate(5);

        return redirect()->route("Comment.getComentarios", $image_id)->with(
            ["message"=>"Comentario publicado.", "comentarios" =>$comentarios, "imagen" => $image_id]);
    }


    
    
    
    
    
}
