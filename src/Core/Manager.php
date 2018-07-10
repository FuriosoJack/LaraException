<?php


namespace FuriosoJack\LaraException\Core;
use FuriosoJack\LaraException\Exceptions\ExceptionProyect;


/**
 * Class Manager
 * Es capaz de añadirle validaciones persoanizadas antes de realizar en render la excepcion,
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

    /**
     * Obtiene el listado de callback que se realizaran
     * @return array
     */
    public function getCallBacks()
    {
        return $this->exceptionsCallbacks;
    }

    /***
     * AÑade un callback de exception
     * @param $callback
     */
    public function addExceptionCallBack($callback)
    {
        array_push($this->exceptionsCallbacks,$callback);
    }


    /**
     * Obtiene el callback de excepcion que se mostrara
     * Entonces Se obtiene el pimer callback que cumpla con que retorne algo
     * @param $request
     * @param \Exception $exception
     * @return mixed
     */
    public function getCallBack($request, \Exception $exception)
    {
        foreach ($this->exceptionsCallbacks as $callback){
            if(is_callable($callback)){
                $data = call_user_func($callback,$request,$exception);
                if(!is_null($data)){
                    return $data;
                }
            }

        }
    }




}