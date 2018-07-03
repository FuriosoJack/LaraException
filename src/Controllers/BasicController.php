<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FuriosoJack\LaraException\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;


;
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

    public function laraException(Request $request)
    {
        $fileSystem = new Filesystem();

        $info = $fileSystem->get(path_laraException($request->get('errors')));
        dd($info);
       // $info = $request->cookie('lara_exception_code');

        $errors =[];

        if(is_null($info)){
            $errors  = [
                'details' => false,
                'error' => 'LaraException',
                'debugCode' => '0',
                'errors' => []
            ];
        }else{
            //$urlEncode = \Crypt::decrypt($info);
            //\Cookie::forget('lara_exception_code');
            $urlEncode = urldecode($info);
            $errors = json_decode(base64_decode($urlEncode),true);
        }
        $errors['routeBack'] = redirect()->back()->getTargetUrl();
        return view("lara_exception::error",$errors);
    }

}
