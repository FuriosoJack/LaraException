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
   
    
    
    public function boot()
    {

        //Registrar helpers
        foreach (glob(__DIR__."/Helpers/*.php") as $fileName){
            require_once $fileName;
        }
    }
    
    /**
     * Se encarga de registrar los servicio de la aplicacion
     */
    public function register()
    {
        //Registra las rutas y macros         
        $this->loadRoutesFrom(__DIR__.'/../routes.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'lara_exception');
        
        //Registra el servicio para la fachada
        $this->app->bind('laraexception',function(){
            
           //$request = app(\Illuminate\Http\Request::class);
           //return app(ExceptionFather::class,[$request]);
           return new ExceptionFather;
        });
    }    
}
