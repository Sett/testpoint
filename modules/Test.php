<?php

require_once 'File.php';

trait Test
{
  /**
   * For working with files
   */
  use File;
  
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


    return $tests;
  }
}
