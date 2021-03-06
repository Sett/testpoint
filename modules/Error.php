<?php
/**
 * Error
 */
trait Error
{
    /**
     * @param array
     */
    public $errors = [];
    
    /**
     * @param array
     */
    public $errorLevels = ['debug' => 0, 'notice' => 1, 'warning' => 2, 'fatal' => 3];
    
    /**
     * @param string $message
     * @param mixed $context
     * @param string $level
     */
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
    
    /**
     * Dump errors into the error.log
     * @event 'the end'
     */
    public function dumpErrors()
    {
        if(!empty($this->errors))
        {
            $logPath = isset($this->onLoad['paths']['error log']) ? $this->onLoad['paths']['error log'] : 'errors.log';
            
            $f = fopen($logPath, "a+t");
            fputs($f, "\n" . json_encode($this->errors) . "\n");
            fclose($f);
        }
    }
}
