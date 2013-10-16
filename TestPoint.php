<?php
/**
 * Class TestPoint
 */
class TestPoint
{
    /**
     * @var string
     */
    public $recordsFile = 'records.json';

    /**
     * @param string $player
     * @param array $tests
     */
    public function __construct($player = '', $tests = [])
    {
        if($player && count($tests))
            $this->run($player, $tests);
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
        {
            preg_match('/.+\((\d)\s.+/', $result, $pockets);// get the count of tests
            $points = $pockets[1];// for each test gain 1 point
            return ['OK' => true, 'data' => $points];
        }
        else
        {
            preg_match('/Tests:\s(\d).+Failures:\s(\d)/', $result, $pockets);// get the count of tests and failures
            $totalPoints = $pockets[1];// the count of tests
            $losePoints = $pockets[2];
            return ['OK' => false, 'data' => ['total' => $totalPoints, 'lose' => $losePoints]];
        }
    }

    /**
     * @param string $player
     * @param array $result
     */
    public function log($player, $result)
    {
        $log = json_decode(file_get_contents($this->recordsFile), true);
        if(!isset($log[$player]))
            $log[$player] = ['points' => 0, 'log' => []];

        if($result['OK'])
        {
            $log[$player]['points'] += $result['data'];
            $log[$player]['log'][] = ['status' => 'WIN', 'datetime' => date('Y-m-d H:i:s'), 'points' => $result['data']];
        }
        else
        {
            $log[$player]['points'] -= $result['data']['lose'];
            $log[$player]['log'][] = [
                'status' => 'lose',
                'datetime' => date('Y-m-d H:i:s'),
                'points' => $result['data']['lose'],
                'possible' => $result['data']['total']
            ];
        }

        file_put_contents($this->recordsFile, json_encode($log));
    }

    /**
     * @param string $test
     * @return array
     */
    public function exec($test)
    {
        exec('phpunit ' . $test, $output);
        return $output;
    }
}
