<?php
/**
 * operate mode
 */
trait Mode
{
  public $mode = 'talk';
  
  public $talkTypes = [
    'h1' => '=====| $talk |=====',
    'h2' => '===| $talk |===',
    'endOfEpisode' => '$talk' . "\n\n",
    'default' => '$talk'
  ];
  
  public function say($text, $type)
  {
    if(($this->mode == 'talk') && isset($this->talkTypes[$type]))
      echo str_replace('$talk', $text, $this->talkTypes[$type]);
  }
}
