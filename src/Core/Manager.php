<?php


namespace FuriosoJack\LaraException\Core;
use FuriosoJack\LaraException\Exceptions\ExceptionProyect;


/**
 * Class Manager
 * @package FuriosoJack\LaraException\Core
 * @author FuriosoJack <iam@furiosojack.com>
 */
class Manager
{

    private $exceptionsCallbacks;

    public function __construct()
    {
        $this->exceptionsCallbacks = [
            function($request, \Exception $exception){
                //Se valida si la exepcion este este paquete para renderizarla de la forma que se quiere
                if($exception instanceof ExceptionProyect){
                    return $exception->renderException();
                }
            }
        ];
    }

    public function addExceptionCallBack($callback)
    {
        array_push($this->exceptionsCallbacks,$callback);
    }


    public function getCallBack($request, \Exception $exception)
    {
        foreach ($this->exceptionsCallbacks as $callback){
            if(is_callable($callback)){
                return call_user_func($callback,$request,$exception);
            }
        }
    }




}