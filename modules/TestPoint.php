<?php

trait TestPoint
{
    /**
     * @var string
     */
    public $player = '';

    /**
     * @param string $testPath tests names or a directory name, where tests are stored
     * @param string $onLoadConfig path/to/file
     */
    public function __construct($testPath = '', $onLoadConfig = '')
    {
        $config = $onLoadConfig ? $onLoadConfig : __DIR__ . '/../application/configs/onload.json';

        $this->applyConfig($config);
        $this->run($testPath);
    }

    /**
     * @param $tests
     */
    public function run($tests)
    {
        $this->event('start test', [$this->player, $tests])
             ->event('run test', $tests)
             ->event('test result', $this->getEventResult('run test'))
             ->event('results', $this->getEventResult('test result'))
             ->event('testing output', $this->getEventResult('run test'))
             ->event('the end');
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
