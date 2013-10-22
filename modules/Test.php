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
    return $this->getFiles($directory, '/*.php', true);
  }
}
