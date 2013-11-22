<?php
/**
 * Class Log
 */
trait Log
{
    /**
     * @param array|string $output
     */
    public function logTestingOutput($output)
    {
        if(is_array($output))
            $output = implode("\n", $output);

        if($this->logExec)
        {
            $this->say('Log', 'h2')->say('Logging testing output into ' . $this->colorText($this->execLogFile, 'underline'));
            file_put_contents($this->execLogFile, "[" . date('Y-m-d H:i:s') . "]\n" . $output . "\n\n");
        }
    }
}
