<?php
require_once '../modules/lib/Manager.php';

TestPoint_Manager::compile('TestManager', __DIR__ . '/../application/configs/compile', 'php');

require_once 'TestPoint.php';

$tp = new TestPoint('sett', [__DIR__ . '/../tests/TestPointTest.php'], true);
