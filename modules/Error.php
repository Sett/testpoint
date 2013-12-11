<?php

trait Error
{
    public $errors = [];
    
    public $errorLevels = ['debug' => 0, 'notice' => 1, 'warning' => 2, 'fatal' => 3];
    
    public function addError($message = '', $context = null, $level = 'notice')
    {
        $this->errors[] = [
            "message" => $message,
            "context" => $context,
            "level"   => $level
        ];
    }
}
