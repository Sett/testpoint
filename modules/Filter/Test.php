<?php

trait Filter_Test
{
  public $skipTests = [];
  
  public function filterTests(array $tests)
  {
    return array_diff($tests, $this->skipTests);
  }
}
