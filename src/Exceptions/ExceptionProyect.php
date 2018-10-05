<?php

namespace FuriosoJack\LaraException\Exceptions;

use Throwable;

/**
 * Class ExceptionProyect
 * @package FuriosoJack\LaraException\Exceptions
 * @author Juan Diaz - FuriosoJack <iam@furiosojack.com>
 */
class ExceptionProyect extends \Exception
{

    private $details;
    private $allErrors;
    private $httpCode;


    public function __construct($messageException, $debugCode, $details, $erorrs, $httpCode = 200)
    {


        $this->message = $messageException;
        $this->code = $debugCode;
        $this->details = $details;
        $this->allErrors = $erorrs;
        $this->httpCode = $httpCode;
    }

    /**
     * @return string
     */
    public function getMessageException(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }

    public function setDetails($details)
    {
        $this->details = $details;
    }

    /**
     * @return int
     */
    public function getDebugCode()
    {
        return $this->code;
    }

    /**
     * Añade errores
     * @param $errors
     */
    public function setErrors($errors)
    {
        $this->allErrors = $errors;
    }

    /**
     * Obtiene el listado de errores
     * @return mixed
     */
    public function getErrors()
    {
        return $this->allErrors;
    }

    /**
     * Obtiene el codigo de http que tendra la solicitud
     * @return int
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }

    /**
     * @param int $httpCode
     */

    public function setHttpCode(int $httpCode)
    {
        $this->httpCode = $httpCode;
    }

    /**
     * convierte el Objeto en un array
     * @return array
     */

    public function toArray()
    {
        return [
            'message' => $this->getMessageException(),
            'errors' => $this->getErrors(),
            'debugCode' => $this->getDebugCode(),
            'details' => $this->getDetails(),
            'routeBack' => redirect()->back()->getTargetUrl()
        ];
    }

    public function toJsonString()
    {
        return json_encode($this->toArray());
    }


    public function toJsonObject()
    {
        return json_decode($this->toJsonString());
    }


}