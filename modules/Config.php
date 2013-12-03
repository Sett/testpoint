<?php
/**
 * Class Config
 * @use File
 */
trait Config
{
    public $config = null;
  
    public function applyConfig()
    {
        $this->say('Applying config sections', 'h2');
        foreach($this->onload as $property => $data)
        {
            if(method_exists($this, $property . 'ApplyConfig'))
            {
                $this->say(' - ' . $this->colorText($property, 'bold'));
                $this->{$property . 'ApplyConfig'}($data);
            }
            else
                echo 'Unknown config section "' . $property . '"' . "\n";
        }

        return true;
    }
}
