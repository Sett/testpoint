<?php

trait Log_Db_Mysql
{
  public function getLog()
  {
    // todo: connect
    return [];
  }
  
  public function addToLog($log)
  {
    // todo: save into db
  }
  
  public function logOk($log, $result, $player)
  {
    // todo: prepare data for a db
    return $log;
  }
  
  public function logFail($log, $result, $player)
  {
    // todo: prepare data for a db
    return $log;
  }
}
