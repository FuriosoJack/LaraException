<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FuriosoJack\LaraException;
use FuriosoJack\LaraException\Exceptions\ExceptionJSON;
use FuriosoJack\LaraException\Exceptions\ExceptionProyect;
use FuriosoJack\LaraException\Exceptions\ExceptionVIEW;
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
    private $deatils;
    private $log;
    private $showDetails;
    private $errors;



    public function __construct()
    {
        $this->debugCode = 0;
        $this->details = "";
        $this->log = false;
        $this->errors = [];
        $this->showDetails = false;
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
     * Se encarga de le ejecucion para la contruccion de la escepcion
     * @throws ExceptionJSON
     * @throws ExceptionVIEW
     */
    public function build()
    {

        if($this->log){
            $this->renderLog();
        }

        $this->runException();
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
     */
    public function details(string $details)
    {
      $this->details = $details;
      return $this;
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



    /**
     * Devuelve la excepcion que se va a lazar
     * @param string $message
     * @param int $debugCode
     * @param string $details
     * @return RenderException
     */
    private function runException()
    {

        if($this->showDetails){
            throw new ExceptionProyect($this->message,$this->debugCode,$this->details,$this->errors);
        }
        throw new ExceptionProyect($this->message,$this->debugCode,"",$this->errors);
    }


    /**
     * Se encarga de generar el log
     * @param string $message mensaje que aparecera en el log
     * @param string $detatils detalles del error
     */
    private function renderLog()
    {
        Log::error(' *************'
                . ' ' .
                 'Mensaje: '. $this->message . ' || '.
                    'Detalles: '. $this->details . ' || '.
                    'DebugCode: ' . $this->debugCode . " *************"
                );
    }










}
