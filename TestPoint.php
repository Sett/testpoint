<?php
/**
 * Class TestPoint
 * @author Sett
 * @version 0.0.0.1
 */
require_once 'modules/Log/File/Json.php';
require_once 'modules/Test.php';
require_once 'modules/PHPUnit.php';
 
class TestPoint
{
    /**
     * Logging
     */
    use Log_File_Json;
    
    /**
     * For working with test-files
     */
    use Test;
    
    /**
     * exec and analysis for PHPUnit
     */
    use PHPUnit;
    
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
        $this->logExec = $logExec;
        
        if($player && count($tests))
            $this->run($player, $tests);
    }

    /**
     * @param string $player
     * @param array $tests
     */
    public function run($player, $tests)
    {
        $logData = [];
        
        foreach($tests as $test)
        {
            $result = $this->exec($test);
            $logData = array_merge($logData, $result);
            $result = array_pop($result);
            $this->log($player, $this->analyse($result));
        }
        
        if($this->logExec)
            file_put_contents($this->execLog, json_encode($logData));
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
            $log = $this->logOk($log, $result, $player);
        else
            $log = $this->logFail($log, $result, $player);

        $this->addToLog($log);
    }
}
