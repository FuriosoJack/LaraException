<?php
/**
 * Created by PhpStorm.
 * User: Juan
 * Date: 22/02/2018
 * Time: 10:03 AM
 */

namespace FuriosoJack\LaraException\Exceptions;
use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Container\Container;
use Exception;

/**
 * Class LaraExceptionManager Sera la clase manegadora de de excepciones de todo el proyecto
 * @package FuriosoJack\LaraExceptionManager\Exceptions
 */
class LaraExceptionManager extends Handler
{
    public function __construct(Container $container)
    {
        parent::__construct($container);
    }


    public function report(Exception $exception)
    {
        //Solo se dejan los logs por defecto para excepciones que no sean generadas por el paquete
        if(!($exception instanceof ExceptionProyect)){
            parent::report($exception);
        }
    }

    public function render($request, Exception $exception)
    {
        //Se valida si la exepcion este este paquete para renderizarla de la forma que se quiere
        if($exception instanceof ExceptionProyect){
            return $exception->renderException();
        }

        $masterManager = app()->make('LaraExceptionMangerE');
        $callback = $masterManager->getCallBack();
        dd($callback);
        if($callback){
            return $callback;
        }
        return parent::render($request, $exception);
    }

}