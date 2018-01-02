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
    public function basic()
    {
        return response()->laraException(['hola']);
    }
}
