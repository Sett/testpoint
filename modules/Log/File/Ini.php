<?php
/**
 * use TestPoint
 */
trait Log_File_Ini
{
  public function getLog()
  {
    if(is_file($this->recordsFile))
      return parse_ini_file($this->recordsFile);
      
    return [];
  }
  
  public function addToLog($log)
  {
    // todo
  }
  
  public function logOk($log, $result, $player)
  {
    // todo
    return $log;
  }
  
  public function logFail($log, $result, $player)
  {
    // todo
    return $log;
  }
}
