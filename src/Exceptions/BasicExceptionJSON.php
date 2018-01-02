<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FuriosoJack\LaraException\Exceptions;


/**
 * Description of BasicException
 *
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/> 
 */
class BasicExceptionJSON extends \Exception
{
 
    
    private $messageJSON;
    private $httpCodeJSON;    
    
    public function __construct(string $message = "", int $httpCode = 200)
    {
        $this->messageJSON = $message;
        $this->httpCodeJSON = $httpCode;
        
    }
    
    public function render()
    {
        return response()->laraExceptionJson($this->renderResponseJson());
    }
    
    private function renderResponseJson()
    {
        $jsonResponse = [
            'errorMessage' => $this->messageJSON,
            'code' => $this->httpCodeJSON,            
        ];        
        return $jsonResponse;
    }
}
