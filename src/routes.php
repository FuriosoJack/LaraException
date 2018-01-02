<?php
use Illuminate\Support\Facades\Response;

//Macro para response json
Response::macro('laraExceptionJson',function($data){
            return response()->json($data);
        });

