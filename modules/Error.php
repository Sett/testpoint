<?php

trait Error
{
    public $errors = [];
    
    public function addError($message = '', $context = null, $level = 'notice')
    {
        $this->errors[] = [
            "message" => $message,
            "context" => $context,
            "level"   => $level
        ];
    }
}
