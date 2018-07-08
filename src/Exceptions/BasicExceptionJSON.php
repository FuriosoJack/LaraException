<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FuriosoJack\LaraException\Exceptions;


/**
 * Description of BasicException
 * @deprecated
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/> 
 */
class BasicExceptionJSON extends \Exception
{
 
    /**
     *
     * @var string 
     */
    private $messageJSON;
    
    /**
     *
     * @var int
     */
    private $httpCodeJSON;    
    
    /**
     * 
     * @param string $message mensaje del error
     * @param int $httpCode codigo del error
     */    
    public function __construct(string $message = "", int $httpCode = 200)
    {
        $this->messageJSON = $message;
        $this->httpCodeJSON = $httpCode;
        
    }
    /**
     * Hace el render del response
     * @return Response
     */
    public function render()
    {
        return response()->laraExceptionJson($this->renderResponseJson());
    }
    
    /**
     * Se encarga de generar la plantilla del json
     * @return string
     */
    private function renderResponseJson()
    {
        $jsonResponse = [
            'error' => $this->messageJSON,
            'code' => $this->httpCodeJSON,            
        ];        
        return $jsonResponse;
    }
}
