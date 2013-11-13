<?php

require_once 'Filter/Test.php';

/**
* Class Test
* @use File
*/
trait Test
{
    /**
    * For filtering tests to execute
    */
    use Filter_Test;

    public function getTests($directory)
    {
        if(is_array($directory))
        {
            $this->say($this->colorText('Tests for playing: ', ['yellow', 'bold']) . implode("\n", $directory), 'startOfEpisode');
            $tests = $directory;
        }
        else
        {
            $this->say('Start looking tests in', 'startOfEpisode');
            $tests = $this->getFiles($directory, '/*.php', true);
        }

        $tests = $this->filterTests($tests);

        return $tests;
    }
    
    /**
     * @param int $points
     * @param int $lastTestTime
     * @return int
     */
    public function truePoints($points, $lastTestTime)
    {
        // very simple: if you too regular start your tests, than you will be punished
        $trueControl = time() - $lastTestTime - $this->t2tTime;

        if($trueControl < 0)
            return $points + $trueControl;

        return $points;
    }
}
