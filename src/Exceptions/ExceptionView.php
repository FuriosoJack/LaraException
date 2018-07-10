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

    /**
     * Si o no se redireccionara la pagina
     * @var Bool
     */
    private $redirect_page;

    /**
     * Vista de blade que se mostrara
     * @var string
     */
    private $view_path;


    /**
     *
     * @param $viewPath
     */
    public function setViewPath($viewPath)
    {
        $this->view_path = $viewPath;
    }


    /**
     * Establece si se redirecciona o no la pagina
     * @param $redirect
     */
    public function setRedirectPath(bool $redirect = true)
    {
        $this->redirect_page = $redirect;
    }

    /**
     * @return string
     */
    protected function getVewPath()
    {
        return $this->view_path;
    }

    /**
     * @return bool
     */

    protected function getRedirect()
    {
        return $this->redirect_page;
    }

    /**
     * Disactiva la redicion
     */
    public function disableRedirectPage()
    {
        $this->redirect_page = false;
    }

    public function renderException()
    {
        $errors = $this->toArray();
        if($this->getRedirect()){

            //como se va a retornar se utiliza el macro

            $data = [
                'errors' => $errors,
                'view' => $this->getVewPath()
            ];

            return response()->laraException('laraException',$data);
        }

        //Como no se va a redireccionar simplemente se responde con la vista
        return response()->view($this->getVewPath(),$errors,$this->getHttpCode());

    }

}