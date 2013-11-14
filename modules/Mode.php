<?php

require_once 'Mode/Talk/Console.php';

/**
* operate mode
*/
trait Mode
{
    use Mode_Talk_Console;

    public $mode = 'talk';
}
