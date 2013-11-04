<?php
require_once 'modules/lib/Manager.php';

TestPoint_Manager::compile('TestPoint', 'application/configs/onload.json', 'modules/');

require_once 'TestPoint.php';

$tp = new TestPoint('sett', [__DIR__ . '/tests/TestPointTest.php'], true);
