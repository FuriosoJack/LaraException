<?php
/**
 * Created by PhpStorm.
 * User: Juan
 * Date: 05/06/2018
 * Time: 09:04 AM
 */

namespace FuriosoJack\LaraException\Exceptions;
use FuriosoJack\LaraException\Interfaces\RenderException;

/**
 * Class ExceptionView
 * @package FuriosoJack\LaraException\Exceptions
 * @author Juan Diaz - FuriosoJack <iam@furiosojack@gmail.com>
 */
class ExceptionView extends ExceptionProyect implements RenderException
{

    public function renderException()
    {

        return response()->laraException('laraException',$this->toArray());
    }

}