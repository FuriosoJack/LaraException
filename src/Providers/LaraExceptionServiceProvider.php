<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FuriosoJack\LaraException\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use FuriosoJack\LaraException\ExceptionFather;
/**
 * Description of LaraExceptionServiceProvider
 *
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/> 
 */
class LaraExceptionServiceProvider extends ServiceProvider
{
   
    /**
     * Se encarga de registrar los servicio de la aplicacion
     */
    public function register()
    {
        $this->app->bind('laraexception',function(){
           return new ExceptionFather;
        });
    }    
}
