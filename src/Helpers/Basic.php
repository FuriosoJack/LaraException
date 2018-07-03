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