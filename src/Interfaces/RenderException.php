<?php
/**
 * Created by PhpStorm.
 * User: Juan
 * Date: 21/02/2018
 * Time: 04:41 PM
 */

namespace FuriosoJack\LaraException\Interfaces;




interface RenderException
{

    /**
     *  Renderiza el response
     * @return Illuminate\Http\Response $response
     */
    public function renderException();

}