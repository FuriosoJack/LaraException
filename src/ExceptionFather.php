<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FuriosoJack\LaraException;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
/**
 * Description of ExceptionFather
 *
 * @author Juan Diaz - FuriosoJack <http://blog.furiosojack.com/> 
 */
class ExceptionFather
{
   
    
    /**
     * 
     * @param string $message
     * @param int $httpCode
     * @param bool $status
     * @param bool $log
     * @throws Exceptions\BasicExceptionJSON
     */
    public function buildEJson(string $message = "", int $httpCode = 200, bool $log = true)
    {        
               
        if($log)
        {
            $this->renderLog($message);
        }
        
        throw new Exceptions\BasicExceptionJSON($message, $httpCode);
    
    }

    
    private function renderLog($message)
    {
        Log::error(' **************************************** '
                . ''
                . 'Fecha: '. Carbon::now() . '  || '.
                'Mensaje: '. $message                
                );
    }
    
    
    

    
 
    
    
}
