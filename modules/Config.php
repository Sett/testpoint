<?php

require_once 'File.php';
require_once 'Config/Log.php';
require_once 'Config/Test.php';
require_once 'Config/Mode.php';
require_once 'Config/Store.php';

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
        }
        
        return true;
      }
  }
  
  public function loadConfig($path)
  {
      $this->config = $this->getJson($path);
  }
}
