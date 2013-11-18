<?php
/**
 * Class Talk_Html
 */
trait Talk_Html
{
    /**
     * @var string
     */
    public $eol = '<br/>';

    /**
     * @var array
     */
    public $talkTypes = [
        'h1' => "<h1>#talk</h1>",
        'h2' => "<h2>#talk</h2>",
        'startOfEpisode' => "<p>#talk",
        'endOfEpisode' => "#talk</p>",
        'default' => " #talk<br/>",
        'errorHeader' => "<h1 style='color: red'>#talk</h1>",
        'error' => "<span style='color: red'>#talk</span>"
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
                $text = '<span style="color: ' . $c  . '">' . $text . "</span>";
        }

        return $text;
    }

    /**
     * @param string $text
     * @param string $type
     * @param bool $return return string - not add to the output
     * @param bool $push
     * @return $this|string
     */
    public function say($text = 'Hello World', $type = 'default', $return = false, $push = false)
    {
        if(isset($this->talkTypes[$type]))
        {
            $result = str_replace('#talk', $text, $this->talkTypes[$type]);
            if($return)
                return $result;

            $push ? $this->output = $result . $this->output : $this->output .= $result;
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
                file_put_contents('output' . time() .'.html',
                    '<html><head><title>Output for TestPoint</title></head><body>' . $singlePhrase . '</body></html>');
            else
                file_put_contents('output.html',
                    '<html><head><title>Output for TestPoint</title></head><body>' . $this->output . '</body></html>');
        }
    }
}
