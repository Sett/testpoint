<?php
/**
 * use TestPoint
 */
trait Log
{
  public function getLog()
  {
    return json_decode(file_get_contents($this->recordsFile), true);
  }
  
  public function addToLog($log)
  {
    file_put_contents($this->recordsFile, json_encode($log));
  }
  
  public function logOk($log, $result, $player)
  {
    $log[$player]['points'] += $result['data'];
    $log[$player]['log'][] = ['status' => 'WIN', 'datetime' => date('Y-m-d H:i:s'), 'points' => $result['data']];
    return $log;
  }
  
  public function logFail($log, $result, $player)
  {
    $log[$player]['points'] -= $result['data']['lose'];
    $log[$player]['log'][] = [
        'status' => 'lose',
        'datetime' => date('Y-m-d H:i:s'),
        'points' => $result['data']['lose'],
        'possible' => $result['data']['total']
    ];
    
    return $log;
  }
}
