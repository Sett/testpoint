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
     * event => mixed result
     * @var array
     */
    public $eventResult = [];

    /**
     * @param string $name
     * @param mixed $context
     * @return $this
     */
    public function event($name = '', $context = null)
    {
        if(isset($this->eventListener[$name]))
        {
            foreach($this->eventListener[$name] as $listener)
            {
                if(method_exists($this, $listener))
                    $this->eventResult[$name] = $this->$listener($context);
            }
        }

        return $this;
    }

    /**
     * @param string $event
     * @return string
     */
    public function getEventResult($event = '')
    {
        return isset($this->eventResult[$event]) ? $this->eventResult[$event] : '';
    }

    /**
     * @param string $event
     * @param string $listener
     * @return $this
     */
    public function listen($event = '', $listener = '')
    {
        if(!isset($this->eventListener[$event]))
            $this->eventListener[$event] = [];

        $this->eventListener[$event][] = $listener;

        return $this;
    }
}
