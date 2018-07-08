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

    private $redirect_page;

    private $view_path;


    public function setViewPath($viewPath)
    {
        $this->view_path = $viewPath;
    }


    public function setRedirectPath($redirect)
    {
        $this->redirect_page = $redirect;

    }

    protected function getVewPath()
    {
        return $this->view_path;
    }

    protected function getRedirect()
    {
        return $this->redirect_page;
    }

    /**
     *
     */
    public function disableRedirectPage()
    {
        $this->redirect_page = false;
    }

    public function renderException()
    {

        if($this->getRedirect()){
            return response()->laraException('laraException',$this->toArray(),$this->getVewPath());
        }
        return response()->view($this->getVewPath());

    }

}