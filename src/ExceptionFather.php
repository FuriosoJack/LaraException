<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FuriosoJack\LaraException;
use FuriosoJack\LaraException\Exceptions\ExceptionJson;
use FuriosoJack\LaraException\Exceptions\ExceptionProyect;
use FuriosoJack\LaraException\Exceptions\ExceptionView;
use FuriosoJack\LaraException\Interfaces\RenderException;
use Illuminate\Support\Facades\Log;
/**
 * Description of ExceptionFather
 *
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/>
 */
class ExceptionFather
{

    private $message;
    private $debugCode;
    private $details;
    private $log;
    private $showDetails;
    private $errors;
    private $exception;
    private $showErrors;
    private $style;


    const STYLE_DEFUALT = "default";


    public function __construct()
    {
        $this->log = false;
        $this->showDetails = false;
        $this->showErrors = false;
        $this->message = "LARAEXCEPTION";
        $this->style = self::STYLE_DEFUALT;
        $this->redirect = true;
    }

    /**
     *
     * Se encarga de generar la excepcion
     * @param string $message
     * @param int $httpCode
     * @param bool $status
     * @param bool $log
     * @deprecated Ya nosera usado ya que ahora se implementa un creador
     * de excepciones que detecta si la peticion es formato json o http y sera usado solo el metodo build
     * @throws Exceptions\BasicExceptionJSON
     */
    public function buildEJson(string $message = "", bool $log = true)
    {

        $this->message = $message;
        if($log)
        {
            $this->renderLog();
        }


        throw new Exceptions\BasicExceptionJSON($message, 200);

    }




    /**
     * Llena el mensaje y retorna una instancia de el mismo
     * @param string $message
     * @return $this
     */
    public function message(string $message){
        $this->message = $message;
        return $this;

    }

    /**
     * @param array $errors
     * @return $this
     */
    public function errors(array $errors)
    {
        $this->errors = $errors;
        return $this;
    }



    /**
     * Se encarga de llenar el codigo de debuqueo del mensaje de error y retorna una instancia de el
     * @param int $debuCode
     * @return $this
     */
    public function debugCode(int $debuCode)
    {
        $this->debugCode = $debuCode;
        return $this;
    }

    /**
     * Llena
     * @param string $details
     * @deprecated
     */
    public function details(string $details)
    {
        $this->details = $details;
        return $this;
    }

    private function getDetails()
    {
        if($this->showDetails){
            return $this->details;
        }
        return  null;
    }

    public function withLog()
    {
        $this->log = true;
        return $this;
    }

    public function showDetails()
    {
        $this->showDetails = true;
        return $this;
    }

    public function showErrors()
    {
        $this->showErrors = true;
        return $this;
    }

    private function getErrors()
    {
        if($this->showErrors){
            return $this->errors;
        }
        return null;
    }


    /**
     * Asigna un estilo de vista para la exception
     * APica solo cuando la exception se ejecuta en http
     * @param string $style
     */
    public function style($style = self::STYLE_DEFUALT)
    {
        $this->style = $style;
        return $this;
    }


    /**
     *
     * Devuelve el patch de la vista que se va a mostrar en caso de excepcion http
     * @return \Illuminate\Config\Repository|mixed
     */
    private function getVewPath()
    {
        return config('LaraException.'.$this->style . '.view' );
    }

    /**
     * Devuelve la configuracion de la redirecion
     * @return \Illuminate\Config\Repository|mixed
     */
    public function getRedirect()
    {
        return config('LaraException.'.$this->style . '.redirect' );
    }




    /**
     * Valida si en los headers existe el application/json
     * @return bool
     */
    private function isJsonRequest(): bool
    {

        if((request()->hasHeader('Content-Type') && 'application/json' == request()->header('Content-Type')) || (request()->hasHeader('accept') && request()->header('accept') == 'application/json') ){
            return true;
        }
        return false;
    }

    private function buildException()
    {
        if($this->isJsonRequest()){
            $this->setException(new ExceptionJson($this->message,$this->debugCode,$this->details,$this->errors));
        }else{
            $exception = new ExceptionView($this->message,$this->debugCode,$this->details,$this->errors);
            $exception->setViewPath($this->getVewPath());
            $exception->setRedirectPath($this->getRedirect());
            $this->setException($exception);
        }
    }



    private function setException($exception)
    {
        $this->exception = $exception;
    }


    private function getException(): ExceptionProyect
    {
        return $this->exception;
    }


    /**
     * Se encarga de generar el log
     * @param string $message mensaje que aparecera en el log
     * @param string $detatils detalles del error
     */
    private function renderLog()
    {

        Log::error($this->getException()->toJsonString());
    }


    /**
     * Se encarga de le ejecucion para la contruccion de la escepcion
     * @throws ExceptionJSON
     * @throws ExceptionVIEW
     */
    public function build(int $httpCode = 200)
    {
        //Lo primero que todo
        $this->buildException();

        if($this->log){
            $this->renderLog();
        }

        if(!$this->showDetails){
            $this->getException()->setDetails(null);
        }

        if(!$this->showErrors){
            $this->getException()->setErrors(null);
        }

        $this->getException()->setHttpCode($httpCode);

        throw $this->getException();
    }




}
