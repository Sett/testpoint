<?php

trait Config_Mode
{
  public function modeApplyConfig($data)
  {
    if($data == 'talk')
      $this->mode = 'talk';
    else
      $this->mode = 'silence';
  }
}
