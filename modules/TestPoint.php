<?php

trait TestPoint
{
    /**
     * @param string $testPath tests names or a directory name, where tests are stored
     * @param string $onLoadConfig path/to/file
     */
    public function __construct($testPath = '')
    {
        $this->event('on load', $testPath);
    }
}
