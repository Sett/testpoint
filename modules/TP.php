<?php

trait TP
{
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
        $this->say('Constructing TestPoint for "' . $player . '"', 'h1');
        $this->applyConfig(__DIR__ . '/../application/configs/onload.json');
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
            $this->say('Run ' . $test);
            $result = $this->exec($test);
            $logData = array_merge($logData, $result);
            $result = array_pop($result);
            $this->log($player, $this->analyse($result));
        }

        if($this->logExec)
        {
            $this->say('Logging testing output into ' . $this->execLog, 'endOfEpisode');
            file_put_contents($this->execLog, "[" . date('Y-m-d H:i:s') . "]\n" . implode("\n", $logData) . "\n\n");
        }
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