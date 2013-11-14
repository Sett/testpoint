<?php
/**
 * Class Config_System
 */
trait Config_System
{
    /**
     * @param array $data
     */
    public function systemApplyConfig(array $data)
    {
        $title = isset($data['title']) ? $data['title'] : 'TP';
        $version = isset($data['version']) ? $data['version'] : $this->colorText('<Missed System version>', 'red');

        $this->say('System information: ' . $title . ' v' . $version, 'h1', false, true);

        if(isset($data['log']))
        {
            if(isset($data['log']['engine']) && isset($data['log'][$data['log']['engine']]))
            {
                if(method_exists($this, $data['log']['engine'] . 'SystemLog'))
                    $this->{$data['log']['engine'] . 'SystemLog'}($data['log'][$data['log']['engine']]);
            }
        }
    }

    /**
     * @param array $data
     */
    public function dbSystemLog(array $data)
    {
        Mysql::setDbResource($data);
        Mysql::defaultInsert(['player', 'datetime', 'timestamp'],[$this->player, date('H:i:s d.m.Y'), time()]);
    }
}
