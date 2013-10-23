<?php

class TestIncorrect extends PHPUnit_Framework_TestCase
{
    public function testNothing()
    {
        throw new Exception('Test must be failed');
    }
}
