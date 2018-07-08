<?php
if(!function_exists('path_laraException')){
    /**
     * Devuleve la ruta completa de la ubicacion del paquete
     * @param string $path
     * @return string
     */
    function path_laraException($path = '')
    {
        if(is_null($path)){
            return dirname(__DIR__);
        }
        return dirname(__DIR__) . ($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if(!function_exists('lara_exception')){
    /**
     * Devuleve la ruta completa de la ubicacion del paquete
     * @param string $path
     * @return string
     */
    function lara_exception($message): FuriosoJack\LaraException\ExceptionFather
    {
        $lara = new \FuriosoJack\LaraException\ExceptionFather();
        $lara->message($message);
        return $lara;
    }
}


if(!function_exists('lara_exception_masterManager')){
    /**
     * Devuleve la ruta completa de la ubicacion del paquete
     * @param string $path
     * @return string
     */
    function lara_exception_masterManager(): FuriosoJack\LaraException\Core\Manager
    {
        return app()->make('LaraExceptionMasterManger');
    }
}
