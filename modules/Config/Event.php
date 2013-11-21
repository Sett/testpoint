<?php
/**
 * Class Config_Event
 */
trait Config_Event
{
    /**
     * @param $data
     */
    public function eventApplyConfig($data)
    {
        foreach($data as $event => $listeners)
        {
            foreach($listeners as $listener)
                $this->listen($event, $listener);
        }
    }
}
