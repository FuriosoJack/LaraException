<?php
/**
 * Created by PhpStorm.
 * User: Juan
 * Date: 05/06/2018
 * Time: 08:37 AM
 */

namespace FuriosoJack\LaraException\Exceptions;
use FuriosoJack\LaraException\Interfaces\RenderException;

/**
 * Class ExceptionJson
 * @package FuriosoJack\LaraException\Exceptions
 * @author Juan Diaz - FuriosoJack <iam@furiosojack@gmail.com>
 */
class ExceptionJson extends ExceptionProyect implements RenderException
{

    public function renderException()
    {
        $data = array_merge($this->toArray(),["success" => false]);
        return response()->json($data,$this->getHttpCode());
    }

}