<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function config(){
        return view("users.config");  
    }
    
    public function update(Request $request){
       $activeUser = Auth::user();
       $id = $activeUser->id;
  
 
       $validate = $this->validate($request, [
           'name'=>'string|max:255|required',
           'surname'=>'string|max:255|required',
           'nick'=>'string|max:255|required|unique:users,nick,'.$id,
           'email'=>'string|max:255|email|required|unique:users,email,'.$id,
       ]);

       
         $image = $request->file("image");
         if($image){
             $nombreImagen = time()."-".$image->getClientOriginalName();
             Storage::disk("users")->put($nombreImagen, File::get("$image"));
             $activeUser->image = $nombreImagen;
             
         }

         $name = $request->input("name");
       $surname = $request->input("surname");
       $nick = $request->input("nick");
       $email = $request->input("email");
       
      
       
//       Setear los atributos
       $activeUser->name = $name;
       $activeUser->surname = $surname;
       $activeUser->nick = $nick;
       $activeUser->email = $email;
       
       $activeUser->update();
       
       return redirect()->route("config")->with("message","Registro actualziado"); 
    }
    
    public function getImage($filename){
        $file = Storage::disk("users")->get($filename);
        
        return new Response($file, 200);
    }
    
    
}
