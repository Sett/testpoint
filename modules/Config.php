<?php

$configSections = ['Log', 'Test', 'Mode', 'Store'];

foreach($configSections as $section)
  require_once 'Config/' . $section . '.php';

require_once 'File.php';

/**
 * Class Config
 * @use File
 */
trait Config
{
  use Config_Log,
      Config_Test,
      Config_Mode,
      Config_Store;

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
        $this->say('Applying config sections', 'h2');
        foreach($this->config as $property => $data)
        {
          if(method_exists($this, $property . 'ApplyConfig'))
          {
              $this->say(' - ' . $property);
              $this->{$property . 'ApplyConfig'}($data);
          }
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
