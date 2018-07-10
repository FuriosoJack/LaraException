<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FuriosoJack\LaraException\Controllers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


;
/**
 * Description of BasicController
 *
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/>
 */
class BasicController extends Controller
{

    const VIEW_DEFAULT = "LaraException::error";
    /**
     *  Controlador encargado de validar que debe retornar si la vista o el response JSON
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */

    public function laraException(Request $request)
    {



        $storage = Storage::disk('local');
        $fileName = base64_decode(urldecode($request->get('errors')));
        if(!$storage->exists($fileName)){
            $info = null;
        }else{
            $info = $storage->get($fileName);
        }

        $view = self::VIEW_DEFAULT;

       // $info = $request->cookie('lara_exception_code');
        $errors =[];
        if(is_null($info)){
            $errors  = [
                'details' => '',
                'message' => 'LaraException',
                'debugCode' => '0',
                'errors' => [],
                'routeBack' => ''
            ];
        }else{
            //$urlEncode = \Crypt::decrypt($info);
            //\Cookie::forget('lara_exception_code');
            ///$urlEncode = urldecode($info);
            $storage->delete($fileName);

            $data = json_decode(base64_decode($info),true);
            $errors = $data['errors'];
            $view = $data['view'];
        }
        return view($view,$errors);
    }

}
