<?php
/**
 * operate mode
 */
trait Mode
{
  public $mode = 'talk';
  
  public $talkTypes = [
    'h1' => '=====| $talk |=====' . "\n",
    'h2' => '===| $talk |===' . "\n",
    'endOfEpisode' => '$talk' . "\n\n",
    'default' => '$talk' . "\n"
  ];
  
  public function say($text, $type = 'default')
  {
    if(($this->mode == 'talk') && isset($this->talkTypes[$type]))
      echo str_replace('$talk', $text, $this->talkTypes[$type]);
  }
}
