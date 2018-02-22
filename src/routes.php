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

    Route::get('exceptionView',[
        'uses' => function(){

            return view('lara_exception::error');
        },
        'as' => 'exceptionView'
    ]);

    Route::get('exceptionJSON',[
        'uses' => function(){

            $errors = \Session::get('errors');

            $responseJson = [];

            if($errors->has('details') && "" != $errors->first('details'))
            {
                $responseJson['details'] = $errors->first('details');
            }

            $responseJson['error'] = $errors->first('message');

            $responseJson['debugCode'] = $errors->first('debugCode');

            return response()->json($responseJson);
        },
        'as' => 'exceptionJSON'
    ]);
});







