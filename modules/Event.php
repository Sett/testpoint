<?php
/**
 * Class Event
 */
trait Event
{
    /**
     * event => ['action']
     * @var array
     */
    public $eventListener = [];

    /**
     * @param string $name
     * @param $context
     */
    public function event($name = '', $context)
    {
        $this->say('Rised event "' . $name . '"');

        if(isset($this->eventListener[$name]))
        {
            foreach($this->eventListener[$name] as $listener)
            {
                if(method_exists($this, $listener))
                    $this->$listener($context);
            }
        }
    }

    /**
     * @param string $event
     * @param string $listener
     */
    public function listen($event = '', $listener = '')
    {
        if(!isset($this->eventListener[$event]))
            $this->eventListener[$event] = [];

        $this->eventListener[$event][] = $listener;
    }
}
