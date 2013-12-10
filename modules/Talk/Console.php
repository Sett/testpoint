<?php
/**
 * Class Mode_Talk
 */
trait Talk_Console
{
    /**
     * End Of Line
     * @var string
     */
    public $eol = "\n";    
    
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

    /**
     * @param array
     */
    public $talkTypes = [
        'h1' => "\n  \x1b[36;1m=====| #talk |=====\x1b[0m\n\n",
        'h2' => "\n    \x1b[32;1m===| #talk |===\x1b[0m\n\n",
        'startOfEpisode' => "\n #talk\n",
        'endOfEpisode' => " #talk\n\n",
        'default' => " #talk\n"
    ];
    
    /**
     * @var string
     */
    public $output = '';    

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
     * @param bool $return return string - not add to the output
     * @return $this|string
     */
    public function say($text = 'Hello World', $type = 'default', $return = false)
    {
        if(isset($this->talkTypes[$type]))
        {
            $result = str_replace('#talk', $text, $this->talkTypes[$type]);
            if($return)
                return $result;

            $this->output .= $result;
        }

        return $this;
    }
    
    /**
     * @param string $singlePhrase
     */
    public function output($singlePhrase = '')
    {
        if($this->talk == 'on')
        {
            if($singlePhrase)
                echo $singlePhrase;
            else
                echo $this->output;
        }
    }
}
