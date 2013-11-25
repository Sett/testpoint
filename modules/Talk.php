<?php
/**
* operate talking
*/
trait Talk
{
    /**
     * @var string
     */
    public $talk = 'on';

    /**
     * @event start test
     */
    public function startTestTalk()
    {
        $this->say('Start test(s)', 'h1');
    }

    /**
     * @event run test
     * @param string $test
     */
    public function runTestTalk($test = '')
    {
        $this->say($this->colorText('Run ', 'bold') . $test);
    }

    /**
     * @event results
     */
    public function resultsTalk()
    {
        $this->say('Results', 'h2');
    }
}
