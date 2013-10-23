<?php
/**
 * @use Log
 */
trait PHPUnit
{
  public function exec($test)
  {
    exec('phpunit ' . $test, $output);
        
    if($this->logExec)
        file_put_contents($this->execLog, json_encode($output));
    
    return $output;
  }
}
