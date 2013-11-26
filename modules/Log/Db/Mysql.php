<?php
/**
 * Class Log_Db_Mysql
 * @use Test.php::truePoints()
 */
trait Log_Db_Mysql
{
    /**
     * DB pointer
     * @var null
     */
    public $db = null;

    /**
     * @var array
     */
    public $dbCfg = [];

    /**
     * @return array
     */
    public function getLog()
    {
        // todo: connect
        if(isset($this->config['store']['db']))
        {
            $this->dbCfg = $cfg = $this->config['store']['db'];
            $this->db = mysqli_connect($cfg['host'], $cfg['user'], $cfg['password']);
            mysqli_select_db($this->db, $cfg['db name']);
            $q = mysqli_query($this->db, 'SELECT * FROM `' . $cfg['table name'] . '`');

            $result = [];
            while($row = mysqli_fetch_array($q))
            {
                $name = isset($row['testName']) ? $row['testName'] : 'unknown player';
                $result[$name] = [
                    'points'   => isset($row['points']) ? $row['points'] : 0,
                    'datetime' => isset($row['datetime']) ? $row['datetime'] : 0
                ];
            }

            return is_null($result) ? [] : $result;
        }
        return [];
    }

    /**
     * @param array $log
     */
    public function addToLog($log)
    {
        $output = 'Save results into ' . $this->colorText($this->dbCfg['db name'] . ': ' . $this->dbCfg['table name'], 'underline');
        $this->say($output, 'endOfEpisode');

        foreach($log as $player => $data)
        {
            $data['points'] = isset($data['points']) ? $data['points'] : 0;
            $query = 'UPDATE `' . $this->dbCfg['table name'] . '` SET ' .
                     'points=' . $data['points'] . ', datetime=' . time() . ' WHERE testName="' . $player . '"';

            mysqli_query($this->db, $query);
        }
    }

    /**
     * @param array $log
     * @param array $result
     * @param string $player
     * @return array
     */
    public function logOk($log, $result, $player)
    {
        $result['data']  = isset($result['data']) ? $result['data'] : 0;
        $lastTestingTime = isset($log[$player]['datetime']) ? $log[$player]['datetime'] : time();
        $points = $this->truePoints($log[$player]['points'] + $result['data'], $log[$player]['datetime']);

        $log[$player] = [
            'points'    => $points,
            'datetime'  => date('Y-m-d H:i:s')
        ];

        return $log;
    }

    /**
     * @param array $log
     * @param array $result
     * @param string $player
     * @return array
     */
    public function logFail($log, $result, $player)
    {
        $log[$player] = [
            'points' => $log[$player]['points'] - $result['data']['lose'],
            'datetime' => date('Y-m-d H:i:s')
        ];

        return $log;
    }

    /**
     * @param string $player
     * @return array
     */
    public function newLogItem($player = 'new player')
    {
        $q = 'INSERT INTO `' . $this->dbCfg['table name'] .
            '` (testName, points, datetime) VALUES(' .
            '"' . mysqli_escape_string($this->db, $player) . '", 0, 0, 0, ' . time() . ')';

        mysqli_query($this->db, $q);

        return ['points' => 0];
    }
}
