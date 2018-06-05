<?php
/**
 * Created by PhpStorm.
 * User: Juan
 * Date: 21/02/2018
 * Time: 04:42 PM
 */

namespace FuriosoJack\LaraException\Exceptions;

use Throwable;

/**
 * Class ExceptionProyect
 * @package FuriosoJack\LaraException\Exceptions
 * @author Juan Diaz - FuriosoJack <iam@furiosojack.com>
 */
class ExceptionProyect extends \Exception
{

    private $messageException;
    private $details;
    private $debugCode;
    private $allErrors;
    private $httpCode;


    public function __construct($messageException, $debugCode, $details, $erorrs, $httpCode = 200)
    {

        $this->messageException = $messageException;
        $this->debugCode = $debugCode;
        $this->details = $details;
        $this->allErrors = $erorrs;
        $this->httpCode = $httpCode;
    }

    /**
     * @return string
     */
    public function getMessageException(): string
    {
        return $this->messageException;
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
        return $this->debugCode;
    }

    public function setErrors($errors)
    {
        $this->allErrors = $errors;
    }
    public function getErrors()
    {
        return $this->allErrors;
    }

    public function getHttpCode()
    {
        return $this->httpCode;
    }

    public function setHttpCode(int $httpCode)
    {
        $this->httpCode = $httpCode;
    }

    public function toArray()
    {
        return [
            'error' => $this->getMessageException(),
            'errors' => $this->getErrors(),
            'debugCode' => $this->getDebugCode(),
            'details' => $this->getDetails()
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