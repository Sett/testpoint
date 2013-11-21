<?php

trait Config_Log
{
    /**
     * @var string
     */
    public $execLogFile = 'log.json';

    /**
     * @var bool
     */
    public $logExec = false;

    /**
     * @param array $data
     */
    public function logApplyConfig(array $data)
    {
        if(isset($data['on']) && $data['on'])
        {
            $this->logExec = true;
            $this->execLogFile = isset($data['file']) ? $data['file'] : 'log.json';
        }
        else
            $this->logExec = false;
    }
}
