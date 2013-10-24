<?php

trait Config_Log
{
  public function logApplyConfig(array $data)
  {
    if(isset($data['on']) && $data['on'])
    {
      $this->logExec = true;
      $this->execLog = isset($data['file']) ? $data['file'] : 'log.json';
    }
    else
      $this->logExec = false;
  }
}
