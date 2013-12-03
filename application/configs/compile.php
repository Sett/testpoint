<?php
return 
[
    "path" => 
    [
        "class" => "modules/lib/",
        "trait" => "modules/"
    ],

    "traits" => 
    [
        [
            "name" => "TestPoint",
            "traits" => ["Run", "Player"]
        ],
        "Pathfinder",
        "Event",
        "Log",
        "Config_Data_OnLoad",
        [
            "name" => "Config",

            "traits" => 
            [
                "Event",
                "Log",
                "Mode",
                "PHPUnit",
                "Store",
                "System",
                "Talk",
                "Test"
            ]
        ],
        "File",
        [
            "name" => "Log_Db_Mysql",
            "class" => ["Mysql"]
        ],
        "ArrayLib",
        "Test",
        [
            "name" => "PHPUnit",
            "traits" => 
            [
                "Analyse"
            ]
        ],
        [
            "name" => "Talk",
            "traits" => ["Console"]
        ]
    ]
];
