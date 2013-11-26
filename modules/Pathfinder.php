<?php
/**
 * Class Pathfinder
 */
trait Pathfinder
{
    /**
     * @param string $path
     * @return string
     */
    public function path($path = '')
    {
        return __DIR__ . '/../' . $path;
    }
}
