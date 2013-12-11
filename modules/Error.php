<?php

trait Error
{
    /**
     * @param array
     */
    public $errors = [];
    
    public $errorLevels = ['debug' => 0, 'notice' => 1, 'warning' => 2, 'fatal' => 3];
    
    public function addError($message = '', $context = null, $level = 'notice')
    {
        if(isset($this->errorLevels[$level]))
        {
            $errorHash = sha1($message . json_encode($context));
            
            $this->errors[$errorHash] = [
                "message" => $message,
                "context" => $context,
                "level"   => $level
            ];
            
            return $errorHash;
        }
        
        return false;
    }
}
