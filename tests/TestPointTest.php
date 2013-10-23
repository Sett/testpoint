<?php
require_once __DIR__ . '/../TestPoint.php';

class TestPointTest extends PHPUnit_Framework_TestCase
{
  // todo: write own test (((:
  /**
   * @dataProvider testProvider
   */
  public function testTP($player, $result)
  {
    $testPoint = new TestPoint($player, [__DIR__ . '/TestExample.php']);
    $testPoint->log($player, $result);
  }
  
  public function testProvider()
  {
    return [
      ['empty', []],
      ['okTrue', ['OK' => true]],
      ['okFalse', ['OK' => false]],
      ['fullDataOK', ['OK' => true, 'data' => 5]],
      ['fullDataFail', ['OK' => true, 'data' => ['total' => 4, 'lose' => 1]]]
    ];
  }
}
