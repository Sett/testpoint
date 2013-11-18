<?php

trait Config_Talk
{
  public function talkApplyConfig($data)
  {
    if($data == 'on')
      $this->talk = 'on';
    else
      $this->talk = 'off';
  }
}
