<?php

require_once '../TestPoint.php';
// example test
$tp = new TestPoint('sett', [__DIR__ . '/../tests/TestPointTest.php'], true);
$tp->output($tp->say('Finish', 'h1', true));