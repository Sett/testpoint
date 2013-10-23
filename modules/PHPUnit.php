<?php
/**
 * @use Log
 */
trait PHPUnit
{
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
