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
      preg_match('/Tests:\s(\d+).+(Failures:\s(\d))*/', $result, $pockets);// get the count of tests and failures
      $totalPoints = isset($pockets[1]) ? $pockets[1] : 0;// the count of tests
      $losePoints  = isset($pockets[2]) ? $pockets[2] : 0;
      return ['OK' => false, 
              'data' => 
                  [
                      'total' => $totalPoints, 
                      'lose' => $losePoints
                  ]
              ];
  }
}
