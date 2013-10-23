<?php
/**
 * @use Log
 */
require_once 'PHPUnit/Analyse.php';
 
trait PHPUnit
{
  use PHPUnit_Analyse;
  
  /**
   * @param string $test
   * @return array
   */
  public function exec($test)
  {
    exec('phpunit ' . $test, $output);
    return $output;
  }
}
