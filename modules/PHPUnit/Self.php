<?php
// --loader <loader>         TestSuiteLoader implementation to use.
// --printer <printer>       TestSuiteListener implementation to use.
// --repeat <times>          Runs the test(s) repeatedly.

// --process-isolation       Run each test in a separate PHP process.
// --no-globals-backup       Do not backup and restore $GLOBALS for each test.
// --static-backup           Backup and restore static attributes for each test.

// --bootstrap <file>        A "bootstrap" PHP file that is run before the tests.
// -c|--configuration <file> Read configuration from XML file.
// --no-configuration        Ignore default configuration file (phpunit.xml).
// --include-path <path(s)>  Prepend PHP's include_path with given path(s).
// -d key[=value]            Sets a php.ini value.

trait PHPUnit_Self
{

}
