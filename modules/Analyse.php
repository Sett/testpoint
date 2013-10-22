<?php

trait Analyse
{
  public function analyseOk($result)
  {
      preg_match('/.+\((\d+)\s.+/', $result, $pockets);// get the count of tests
      $points = $pockets[1];// for each test gain 1 point
      return ['OK' => true, 'data' => $points];
  }
  
  public function analyseFail($result)
  {
      preg_match('/Tests:\s(\d+).+(Failures:\s(\d))*/', $result, $pockets);// get the count of tests and failures
      $totalPoints = $pockets[1];// the count of tests
      $losePoints  = $pockets[2];
      return ['OK' => false, 
              'data' => 
                  [
                      'total' => $totalPoints, 
                      'lose' => $losePoints
                  ]
              ];
  }
}
