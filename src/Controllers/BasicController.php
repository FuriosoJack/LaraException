<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FuriosoJack\LaraException\Controllers;
use App\Http\Controllers\Controller;;
/**
 * Description of BasicController
 *
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/> 
 */
class BasicController extends Controller
{
    /**
     *  Controlador encargado de validar que debe retornar si la vista o el response JSON
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */

    public function laraException()
    {
        $errors = \Session::get('errors');

        if($this->isJsonRequest()){

            $responseJson = [];

            if($errors->has('details') && "" != $errors->first('details'))
            {
                $responseJson['details'] = $errors->first('details');
            }
            $responseJson['success'] = false;

            $responseJson['error'] = $errors->first('message');

            $responseJson['debugCode'] = $errors->first('debugCode');

            return response()->json($responseJson);
        }
        return view("lara_exception::error");
    }

    /**
     * Valida si en los headers existe el application/json
     * @return bool
     */
    private function isJsonRequest(): bool
    {

        if((request()->hasHeader('Content-Type') && 'application/json' == request()->header('Content-Type')) || (request()->hasHeader('accept') && request()->header('accept') == 'application/json') ){
            return true;
        }
        return false;
    }
}
