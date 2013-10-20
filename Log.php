<?php

trait Log
{
  public function logOk($log)
  {
    $log[$player]['points'] += $result['data'];
    $log[$player]['log'][] = ['status' => 'WIN', 'datetime' => date('Y-m-d H:i:s'), 'points' => $result['data']];
    return $log;
  }
  
  public function logFail($log)
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
