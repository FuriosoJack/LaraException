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
        ];
    }

    public function addExceptionCallBack($callback)
    {
        array_push($this->exceptionsCallbacks,$callback);
    }


    public function getCallBack()
    {
        foreach ($this->exceptionsCallbacks as $callback){
            if(is_callable($callback)){
                return call_user_func($callback);
            }
        }
    }




}