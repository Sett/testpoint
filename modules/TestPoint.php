<?php

trait TestPoint
{
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

        $config = $onLoadConfig ? $onLoadConfig : __DIR__ . '/../application/configs/onload.json';

        $this->applyConfig($config);

        $tests = $this->getTests($tests);
        $this->logExec = $logExec;

        if($player && count($tests))
            $this->runMulti($player, $tests);
    }

    public function runMulti($player, $tests)
    {
        $this->say('Start test(s)', 'h1')
            ->say($this->colorText('Run ', 'bold') . $tests);

        $result     = $this->exec($tests);
        $resultLine = $this->getResultLine($result);

        $this->say('Results', 'h2');
        $this->log($player, $this->analyse($resultLine));
        $this->event('testing output', $result);
        $this->output();
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

            $resultLine  = $this->getResultLine($result);

            $this->say('Results', 'h2');
            $this->log($player, $this->analyse($resultLine));
        }

        $this->event('testing output', $logData);
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
            $log[$player] = $this->newLogItem($player);

        if($result['OK'])
            $log = $this->logOk($log, $result, $player);
        else
            $log = $this->logFail($log, $result, $player);

        $this->addToLog($log);
    }
}
