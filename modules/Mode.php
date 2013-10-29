<?php

require_once 'Mode/Talk.php';

/**
* operate mode
*/
trait Mode
{
    use Mode_Talk;

    public $mode = 'talk';
}
