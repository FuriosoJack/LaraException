<?php
/**
 * Created by PhpStorm.
 * User: Juan
 * Date: 21/02/2018
 * Time: 04:42 PM
 */

namespace FuriosoJack\LaraException\Exceptions;


use FuriosoJack\LaraException\Interfaces\Illuminate;
use FuriosoJack\LaraException\Interfaces\RenderException;

class ExceptionVIEW extends ExceptionProyect
{
    /**
     *  Renderiza el response
     * @return response
     */
    public function renderException()
    {
        return response()->laraException('exceptionView',[
            'debugCode' => $this->getDebugCode(),
            'message' => $this->getMessageException(),
            'details' => $this->getDetails()
        ]);
    }
}