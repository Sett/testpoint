<?php

$configSections = ['Log', 'Test', 'Mode', 'Store'];

foreach($configSections as $section)
  require_once 'Config/' . $section . '.php';

require_once 'File.php';

trait Config
{
  use File;
  use Config_Log;
  use Config_Test;
  use Config_Mode;
  use Config_Store;

  public $config = null;
  
  public function applyConfig($path)
  {
      if(is_null($this->config))
      {
        $this->loadConfig($path);
        return $this->applyConfig($path);
      }
      else
      {
        foreach($config as $property => $data)
        {
          if(property_exists($this, $property . 'ApplyConfig'))
            $this->{$property . 'ApplyConfig'}($data);
          else
            echo 'Unknown config section "' . $property . '"' . "\n";
        }
        
        return true;
      }
  }
  
  public function loadConfig($path)
  {
      $this->config = $this->getJson($path);
  }
}
