<?php
/**
 * Class TestPoint
 * @author Sett
 * @version 0.0.0.1
 */
 require_once 'modules/Analyse.php';
 require_once 'modules/Log.php';
 require_once 'modules/Test.php';
 
class TestPoint
{
    /**
     * Analyses logic
     */
    use Analyse;
    
    /**
     * Logging
     */
    use Log;
    
    /**
     * For working with test-files
     */
    use Test;
    
    /**
     * @var string
     */
    public $recordsFile = 'records.json';
    
    /**
     * @var string
     */
    public $execLog = 'log.json';

    /**
     * @var bool
     */
    public $logExec = false;

    /**
     * @param string $player
     * @param array|string $tests tests names or a directory name, where tests are stored
     * @param bool $logExec
     */
    public function __construct($player = '', $tests = [], $logExec = false)
    {
        $tests = is_array($tests) ? $tests : $this->getTests($tests);
        
        if($player && count($tests))
            $this->run($player, $tests);
            
        $this->logExec = $logExec;
    }

    /**
     * @param string $player
     * @param array $tests
     */
    public function run($player, $tests)
    {
        foreach($tests as $test)
        {
            $result = $this->exec($test);
            $result = array_pop($result);
            $this->log($player, $this->analyse($result));
        }
    }

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

    /**
     * @param string $player
     * @param array $result
     */
    public function log($player, $result)
    {
        $log = $this->getLog();
        if(!isset($log[$player]))
            $log[$player] = ['points' => 0, 'log' => []];

        if($result['OK'])
            $log = $this->logOk($log);
        else
            $log = $this->logFail($log);

        $this->addToLog($log);
    }

    /**
     * @param string $test
     * @return array
     */
    public function exec($test)
    {
        exec('phpunit ' . $test, $output);
        
        if($this->logExec)
            file_put_contents($this->execLog, json_encode($output));
        
        return $output;
    }
}
