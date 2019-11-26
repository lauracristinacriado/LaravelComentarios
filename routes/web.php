<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */
//
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/config', 'UserController@config')->name('config');
Route::post('/update', 'UserController@update')->name('users.update');
Route::get('/update/users/{filename}', 'UserController@getImage')->name('users.avatar');

Route::get('/image/create', 'ImageController@create')->name('image.create');
Route::post('/image/save', 'ImageController@save')->name('image.save');
Route::get('/image/{filename}', 'ImageController@getImage')->name('image.getImage');


Route::get('/comentarios/{id}', 'CommentController@getComentarios')->name('Comment.getComentarios');
Route::post('/comentario/save', 'CommentController@saveComentario')->name('Comment.saveComentario');

//use App\Image;
//use App\User;
//
//Route::get('/', function () {
//    $imagenes = Image::orderBy("id", "desc")->get();
//    foreach($imagenes as $imagen){
//
//    echo $imagen->image_path."<br>";
//    echo $imagen->description."<br>";
//
//
//    foreach($imagen->comments as $comment){
//
//        echo $comment->content."<br>";
//        echo $comment->created_at."<br>";
//         echo "<hr>";
//    }
//
//}
//    
//    
//    
//    $user = User::find(3);
//   
//        echo $user->name."<br>";
//        echo $user->surname."<br>";
//       
//       
//    
//    
//    });