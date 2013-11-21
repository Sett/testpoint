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
     *
     */
    public function startTestTalk()
    {
        $this->say('Start test(s)', 'h1');
    }

    /**
     * @param string $test
     */
    public function runTestTalk($test = '')
    {
        $this->say($this->colorText('Run ', 'bold') . $test);
    }

    /**
     *
     */
    public function resultsTalk()
    {
        $this->say('Results', 'h2');
    }
}
