<?php
/**
 * Class TestPoint_Run
 */
trait TestPoint_Run
{
    /**
     * @param $tests
     * @return $this
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
}
