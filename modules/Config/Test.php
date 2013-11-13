<?php

trait Config_Test
{
    public $t2tTime = 0;

    public function testApplyConfig($data)
    {
        if(isset($data['skipTests']))
            $this->skipTests = $data['skipTests'];

        if(isset($data['test-to-test time']))
            $this->t2tTime = $data['test-to-test time'];
    }
}
