<?php
/**
 * Как идея, подцеплять нужный конфиг трейтом, а не реквайрить/парсить файл
 */
trait Config_Data_OnLoad
{
    /**
     * @var array
     */
    public $onLoad = 
    [
      "paths" => 
      [
          "error log" => "/log/error.log"
      ],    
        
      "talk" => "on",
  
      "system" =>
      [
          "title" => "TestPoint",
          "version" => "0.0.start.9",
          "player" => "sett",
          "log" =>
          [
              "engine" => "db",
              "db" =>
              [
                  "host" => "localhost",
                  "user" => "tp",
                  "password" => "tp",
                  "db name" => "test-tp",
                  "table name" => "test_log"
              ]
          ]
      ],
  
      "event" =>
      [
          "on load"        => ["applyConfig", "run"],
          "start test"     => ["startTestTalk"],
          "run test"       => ["runTestTalk", "exec"],
          "test result"    => ["getResultLine"],
          "results"        => ["resultsTalk", "analyse", "log"],
          "testing output" => ["logTestingOutput"],
          "the end"        => ["output", "dumpErrors"]
      ],
  
      "log" =>
      [
          "file" => "log.json",
          "on" => 1
      ],
  
      "store" =>
      [
          "engine" => "file",
  
          "file" =>
          [
              "name" => "records.json"
          ],
          
          "db" => 
          [
              "mysql" => 
              [
                  "host" => "localhost",
                  "user" => "tp",
                  "password" => "tp",
                  "db" => "test-tp",
                  "table name" => "test_results"
              ]
          ]
      ],
      
      "test" =>
      [
          "skipTests" => [],
          "test-to-test time" => 300
      ],
      
      "phpunit" => 
      [
          "log" => 
          [
              "turn" => "off",
              "type" => "json",
              "fileName" => "pu-log.json"
          ],
          
          "coverage" =>
          [
              "turn" => "off",
              "type" => "html",
              "fileName" => "pu-coverage"
          ],
          
          "testdox" =>
          [
              "turn" => "on",
              "type" => "html",
              "fileName" => "pu-doc.html"
          ],
          
          "filter" =>
          [
              "turn" => "on",
              "pattern" => "",
              "groups list" => [],
              "group" => "",
              "exclude" => ""
          ],
          
          "self" => 
          [
              "loader" => "",
              "printer"=> "",
              "repeat" => "",
              "process-isolation"=> "on",
              "no-global-backup"=> "",
              "static-backup"=> "",
              "bootstrap" => "",
              "configuration" => "",
              "no-configuration" => ""
          ],
          
          "includePath" => [],
  
          "d" => []
      ]
  ];
}
