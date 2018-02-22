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
use Throwable;

class ExceptionProyect extends \Exception implements RenderException
{

    private $messageException;
    private $details;
    private $debugCode;

    public function __construct(string $messageException = "", int $debugCode = 0, $details = "")
    {
        $this->messageException = $messageException;
        $this->debugCode = $debugCode;
        $this->details = $details;
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
    public function getDetails(): string
    {
        return $this->details;
    }

    public function setDetails(string $details)
    {
        $this->details = $details;
    }

    /**
     * @return int
     */
    public function getDebugCode(): int
    {
        return $this->debugCode;
    }


    /**
     *  Renderiza el response
     * @return Illuminate\Http\Response $response
     */
    public function renderException()
    {
        // TODO: Implement renderException() method.
    }
}