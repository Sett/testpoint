<?php

trait PHPUnit_Analyse
{
  /**
   * @param string $result
   * @return array
   */
  public function analyse($result)
  {
      if(strpos($result, 'OK') !== false)
          return $this->analyseOk($result);
      else
          return $this->analyseFail($result);
  }
  
  public function analyseOk($result)
  {
      preg_match('/.+\((\d+)\s.+/', $result, $pockets);// get the count of tests
      $points = $pockets[1];// for each test gain 1 point
      return ['OK' => true, 'data' => $points];
  }
  
  public function analyseFail($result)
  {
      $pattern = '/Tests:\s(\d+),\s*(Assertions:\s*(\d+))*,\s*(Errors:\s*(\d+))*\s*(Failures:\s*(\d+))*/';
      preg_match($pattern, $result, $pockets);// get the count of tests and failures
      $totalPoints = isset($pockets[1]) ? $pockets[1] : 0;// the count of tests
      $losePoints  = isset($pockets[5]) ? $pockets[5] : 0;// the count of errors
      $losePoints  += isset($pockets[7]) ? $pockets[7] : 0;// the count of failures
      return ['OK' => false, 
              'data' => 
                  [
                      'total' => $totalPoints, 
                      'lose' => $losePoints
                  ]
              ];
  }
}
