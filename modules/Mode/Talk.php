<?php
/**
 * Class Mode_Talk
 */
trait Mode_Talk
{
    /**
     * @var array
     */
    public $colors = [
        // colors
        'red' => "\x1b[31m",
        'yellow' => "\x1b[33m",
        'blue' => "\x1b[34m",
        'green' => "\x1b[32m",
        'cyan' => "\x1b[36m",
        'purple' => "\x1b[35m",
        // text styles
        'bold' => "\x1b[1m",
        'underline' => "\x1b[4m"
    ];

    public $talkTypes = [
        'h1' => "\n  \x1b[36;1m=====| #talk |=====\x1b[0m\n\n",
        'h2' => "\n    \x1b[32;1m===| #talk |===\x1b[0m\n\n",
        'startOfEpisode' => "\n #talk\n",
        'endOfEpisode' => " #talk\n\n",
        'default' => " #talk\n"
    ];

    /**
     * @param string $text
     * @param string|array $color
     * @return string
     */
    public function colorText($text, $color)
    {
        if(!is_array($color))
            $color = [$color];

        foreach($color as $c)
        {
            if(isset($this->colors[$c]))
                $text = $this->colors[$c] . $text;
        }

        return $text . "\x1b[0m";
    }

    /**
     * @param string $text
     * @param string $type
     */
    public function say($text = 'Hello World', $type = 'default')
    {
        if(($this->mode == 'talk') && isset($this->talkTypes[$type]))
            echo str_replace('#talk', $text, $this->talkTypes[$type]);
    }
}