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
        $this->say('Tests for playing: ' . implode("\n", $directory));
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
}
