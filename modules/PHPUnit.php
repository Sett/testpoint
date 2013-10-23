<?php
/**
 * @use Log
 */
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
