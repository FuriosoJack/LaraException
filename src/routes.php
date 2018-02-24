<?php
use Illuminate\Support\Facades\Response;

//Macro para response json
Response::macro('laraExceptionJson',function($data){
            return response()->json($data);
        });

/*
//Macro para response de cualquiera
Response::macro('laraException',function(callable $callback){
    //return response()->json(['fg']);
    return call_user_func($callback);
});*/
Response::macro('laraException',function(string $route, array $data){
    //return response()->json(['fg']);
    return redirect()->route($route)->withErrors($data);
});

Route::group(['middleware' => ['web']],function(){

    Route::get('/laraexception',[
        'uses' => 'FuriosoJack\LaraException\Controllers\BasicController@laraException',
        'as' => 'laraException'
    ]);

});







