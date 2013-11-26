<?php
/**
 * Class Log
 */
trait Log
{
    /**
     * @event testing output
     * @param array|string $output
     */
    public function logTestingOutput($output)
    {
        if(is_array($output))
            $output = implode("\n", $output);

        if($this->logExec)
        {
            $this->say('Log', 'h2')->say('Logging testing output into ' . $this->colorText($this->execLogFile, 'underline'));
            file_put_contents(__DIR__ . '/../' .$this->execLogFile, "[" . date('Y-m-d H:i:s') . "]\n" . $output . "\n\n");
        }
    }
    
    
    /**
     * @param array $result
     */
    public function log($result)
    {
        $log = $this->getLog();

        if(!isset($log[$this->player]))
            $log[$this->player] = $this->newLogItem($this->player);

        if($result['OK'])
            $log = $this->logOk($log, $result, $this->player);
        else
            $log = $this->logFail($log, $result, $this->player);

        $this->addToLog($log);
    }
}
