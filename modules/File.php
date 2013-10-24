<?php

trait File
{
  public function getJson($path, $asArray = true)
  {
    if(is_file($path))
      return json_decode(file_get_contents($path), $asArray);
      
    return [];
  }
  
  public function getFiles($directory, $fileMask, $lookInSubdirs = false)
  {
    $directories = [];
    
    if($lookInSubdirs)
    {
      $this->say($directory);
      $baseDir =$directory;
      while($dirs = glob($baseDir . '/*', GLOB_ONLYDIR))
      {
          $this->say(implode("\n", $dirs));
          $directories = array_merge($directories, $dirs);
          $baseDir .= '/*';
      }
    }
    else
      $directories[] = $directory;
    
    $this->say('Directories to search : ' . count($directories), 'endOfEpisode');
    
    $files = [];
    
    $this->say('Found tests: ');
    foreach($directories as $dir)
    {
      $found = glob($dir . $fileMask);
      $this->say(implode(";\n", $found));
      $files = array_merge($files, $found);
    }
    $this->say('total: ' . count($files));
        
    return $files;
  }
}
