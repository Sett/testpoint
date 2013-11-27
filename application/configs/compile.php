[
    "path" => 
    [
        "class" => "modules/lib/",
        "trait" => "modules/"
    ],

    "traits" => 
    [
        "TestPoint",
        "Pathfinder",
        "Event",
        "Log",
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
]
