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
    $this->say('Start looking tests in', 'startOfEpisode');
    return $this->getFiles($directory, '/*.php', true);
  }
}
