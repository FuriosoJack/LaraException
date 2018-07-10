<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FuriosoJack\LaraException\Providers;
use FuriosoJack\LaraException\Core\Manager;
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

    const TAGS_PUBLISHED = ['config.lara_exception' => 'config.lara_exception',
                            'views' => 'views.lara_exception'];


    public function boot()
    {        //Registrar helpers
        foreach (glob(dirname(__DIR__)."/Helpers/*.php") as $fileName){
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

        $this->publishFiles();


        //Se registra el singleton
        $this->app->singleton('LaraExceptionMasterManger',function(){
           return new Manager();
        });

    }


    public function publishFiles()
    {

        $publishable = [
            self::TAGS_PUBLISHED['config.lara_exception'] => [
                __DIR__.'/../Config/LaraException.php' => config_path('LaraException.php')
            ],
            self::TAGS_PUBLISHED['views'] => [
                __DIR__.'/../resources/views' => resource_path('views/vendor/LaraException'),
            ],
        ];

        foreach ($publishable as $tag => $path){
            $this->publishes($path,$tag);
        }

    }
}
