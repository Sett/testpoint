<?php
/**
 * Class TestPoint
 * @author Sett
 * @version 0.0.0.1
 */
require_once 'modules/Log/File/Json.php';
require_once 'modules/Test.php';
require_once 'modules/PHPUnit.php';
require_once 'modules/Mode.php';
require_once 'modules/Config.php';
require_once 'modules/File.php';
 
class TestPoint
{
    /**
     * TP configuration
     */
    use Config,

    /**
     * For working with files
     */
    File,
 
    /**
     * Logging
     */
    Log_File_Json,
    
    /**
     * For working with test-files
     */
    Test,
    
    /**
     * exec and analysis for PHPUnit
     */
    PHPUnit,
    
    /**
     * TestPoint mode: talk or silence
     */
    Mode;
    

    /**
     * @var string
     */
    public $execLog = 'log.json';

    /**
     * @var bool
     */
    public $logExec = false;
    
    /**
     * @var string
     */
    public $player = '';    

    /**
     * @param string $player
     * @param array|string $tests tests names or a directory name, where tests are stored
     * @param bool $logExec
     * @param string $onLoadConfig path/to/file
     */
    public function __construct($player = '', $tests = [], $logExec = false, $onLoadConfig = '')
    {
        $this->player = $player;
        $this->say('Constructing TestPoint for "' . $player . '"', 'h1');
        
        $config = $onLoadConfig ? $onLoadConfig : __DIR__ . '/application/configs/onload.json';
        $this->applyConfig($config);
        
        $tests = $this->getTests($tests);
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
        $this->say('Start test(s)', 'h1');
        $logData = [];
        
        foreach($tests as $test)
        {
            $this->say($this->colorText('Run ', 'bold') . $test);
            $result  = $this->exec($test);
            $logData = array_merge($logData, $result);
            $resultLine  = array_pop($result);

            $start = time();

            while(strpos($resultLine, 'tests') === false)
            {
                $resultLine = array_pop($result);
                if((time() - $start) > 30)// to avoide unreached cycles
                    break;
            }
            
            $this->log($player, $this->analyse($resultLine));
        }
        
        if($this->logExec)
        {
          $this->say('Logging testing output into ' . $this->colorText($this->execLog, 'underline'), 'endOfEpisode');
          file_put_contents($this->execLog, "[" . date('Y-m-d H:i:s') . "]\n" . implode("\n", $logData) . "\n\n");
        }
        
        $this->output();
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
