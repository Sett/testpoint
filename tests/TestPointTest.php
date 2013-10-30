<?php
require_once __DIR__ . '/../TestPoint.php';

/**
 * Class TestPointTest
 * @author Se#
 * @use TestPoint
 */
class TestPointTest extends PHPUnit_Framework_TestCase
{
    /**
    * Test the main TestPoint class
    * @dataProvider testProvider
    */
    public function testTP($player, $test)
    {
        new TestPoint($player, [__DIR__ . '/' . $test]);
    }

    /**
     * Provide data for the testTP
     * @return array
     */
    public function testProvider()
    {
        return [
          ['correct test', 'TestExample'],
          ['failed test', 'TestIncorrect']
        ];
    }
}
