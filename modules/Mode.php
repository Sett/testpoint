<?php
/**
 * operate mode
 */
trait Mode
{
  public $mode = 'talking';
  
  public $talkTypes = [
    'h1' => '===== $talk =====',
    'h2' => '=== $talk ===',
    'endOfEpisode' => '$talk' . "\n\n",
    'default' => '$talk'
  ];
  
  public function say($text, $type)
  {
    if(($this->mode == 'talking') && isset($this->talkTypes[$type]))
      echo str_replace('$talk', $text, $this->talkTypes[$type]);
  }
}
