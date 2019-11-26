<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Image;
use App\User;

class ImageController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function create(){
        return view("images.create");
    }
    
    
    public function save(Request $request){
        $user_id = \Auth::user()->id;
        $objImage = new Image;
        $image_path = $request->file("image_path");
        $description = $request->input("description");
        
        $validate = $this->validate($request, 
               [ "description" => "string|required",
                 "image_path" => "image|required"                   
        ]);
        
        if($image_path){
            $imageName = time()."-".$image_path->getClientOriginalName();
            Storage::disk("images")->put($imageName , File::get($image_path));
            $objImage->image_path = $imageName;

        }
  
        $objImage->user_id = $user_id;
        $objImage->description = $description;
        $objImage->save();
        
        return redirect()->route("image.create")->with(["message"=>"Imagen publicada. "]);
    }
    
    
    public function getImage($filename){
        $file = Storage::disk("images")->get($filename);
        
        return new Response($file, 200);
    }
    
    
     public function detail($id){
        $img = Image::find($id);
        var_dump($img);
        
    }


    
}
