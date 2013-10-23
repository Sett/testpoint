<?php
/**
 * @use Log
 */
trait PHPUnit
{
  public function exec($test)
  {
    exec('phpunit ' . $test, $output);
    return $output;
  }
}
