<?php
require_once 'modules/lib/Manager.php';

TestPoint_Manager::compile('TestManager', 'application/configs/onload.json', 'modules/');

require_once 'TestManager.php';

$tp = new Testmanager('sett', [__DIR__ . '/tests/TestPointTest.php'], true);