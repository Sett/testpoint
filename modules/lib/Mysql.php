<?php
/**
 * Class Mysql
 */
class Mysql
{
    /**
     * @var array
     */
    public static $dbCfg = [];

    /**
     * @var null
     */
    public static $dbRes = null;

    /**
     * @param array $config
     */
    public static function setDbResource($config = [])
    {
        self::$dbCfg = $config;

        self::$dbRes = mysqli_connect(self::$dbCfg['host'], self::$dbCfg['user'], self::$dbCfg['password']);
        mysqli_select_db(self::$dbRes, self::$dbCfg['db name']);
    }

    /**
     * @return bool|mysqli_result
     */
    public static function selectAll()
    {
        return mysqli_query(self::$dbRes, 'SELECT * FROM `' . self::$dbCfg['table name'] . '`');
    }

    /**
     * @param $queryResult
     * @return array|null
     */
    public static function asArray($queryResult)
    {
        return mysqli_fetch_array($queryResult);
    }

    /**
     * @param $query
     * @return bool|mysqli_result
     */
    public static function query($query)
    {
        return mysqli_query(self::$dbRes, $query);
    }

    /**
     * @param $player
     * @return bool|mysqli_result
     */
    public static function insert($player)
    {
        return self::defaultInsert(
            ['player', 'points', 'datetime'],
            [mysqli_escape_string(self::$dbRes, $player), 0, time()]
        );
    }

    /**
     * @param array $fields
     * @param array $values
     * @param string $tableName
     * @return bool|mysqli_result
     */
    public static function defaultInsert($fields = [], $values = [], $tableName = '')
    {
        $tableName = $tableName ? $tableName : self::$dbCfg['table name'];

        $q = 'INSERT INTO `' . $tableName . '` (' . implode(',', $fields) . ') VALUES("' . implode('","', $values) . '")';
        file_put_contents('dbcheck.json', $q);
        return self::query($q);
    }

    public static function update($player, $points)
    {
        $query = 'UPDATE `' . self::$dbCfg['table name'] . '` SET ' .
            'points=' . $points . ', datetime=' . time() . ' WHERE testName="' . $player . '"';

        return self::query($query);
    }
}
