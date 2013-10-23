<?php
require_once __DIR__ . '/../TestPoint.php';

class TestPointTest extends PHPUnit_Framework_TestCase
{
  /**
   * @dataProvider testProvider
   */
  public function testTP($player, $test)
  {
    $testPoint = new TestPoint($player, [__DIR__ . '/' . $test]);
  }
  
  public function testProvider()
  {
    return [
      ['correct test', 'TestExample'],
      ['failed test', 'TestIncorrect']
    ];
  }
}
