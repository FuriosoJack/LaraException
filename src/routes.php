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

    //return redirect()->action('\FuriosoJack\LaraException\Controllers\BasicController@laraException',['base64' => base64_encode(json_encode($data))]);

    /* session()->push('base64',base64_encode(json_encode($data)));
     session()->save();
     return redirect()->route($route);*/

    $cookie = cookie('lara_exception_code', urlencode(base64_encode(json_encode($data))), '1');
    return redirect()->route($route)->withCookie($cookie);

});

//Route::group(['middleware' => ['web']],function(){

Route::any('/laraexception/',[
    'uses' => '\FuriosoJack\LaraException\Controllers\BasicController@laraException',
    'as' => 'laraException'
]);

//});







