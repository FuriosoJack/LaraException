<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FuriosoJack\LaraException\Facades;
use Illuminate\Support\Facades\Facade;
/**
 * Description of LaraException
 *
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/> 
 */
class LaraExceptionFacade extends Facade
{
    /**
     * Se encarga de retorar la fachada registrada en el service provider
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laraexception';
    }
    
}
