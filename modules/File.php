<?php

trait File
{
  public function getFiles($directory, $fileMask, $lookInSubdirs = false)
  {
    $directories = [];
    
    if($lookInSubdirs)
    {
      $baseDir =$directory;
      while($dirs = glob($baseDir . '/*', GLOB_ONLYDIR))
      {
          $directories = array_merge($directories, $dirs);
          $baseDir .= '/*';
      }
    }
    else
      $directories[] = $directory;
    
    $files = [];
    
    foreach($directories as $dir)
        $files = array_merge($files, glob($dir . $fileMask));
        
    return $files;
  }
}
