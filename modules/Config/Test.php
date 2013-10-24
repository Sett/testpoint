<?php

trait Config_Test
{
  public function testApplyConfig($data)
  {
    if(isset($data['skipTests']))
      $this->skipTests = $data['skipTests'];
  }
}
