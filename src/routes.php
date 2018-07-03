<?php
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;
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
    $dataEncrypted = base64_encode(json_encode($data));
//    $cookie = cookie('lara_exception_code', $dataEncrypted, '1');
    $fileSystem = new Filesystem();
    $fileName = (string)Carbon::now()->timestamp . ".txt";
    $pathFile = path_laraException('TMP/errors/'.$fileName);
    $fileSystem->put($pathFile,$dataEncrypted);
    return redirect()->route($route,['errors' => urlencode(base64_encode($fileName))]);

});

//Route::group(['middleware' => ['web']],function(){

Route::any('/laraexception/',[
    'uses' => '\FuriosoJack\LaraException\Controllers\BasicController@laraException',
    'as' => 'laraException'
]);

//});







