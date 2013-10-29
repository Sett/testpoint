Используется так:

```
require_once 'path/to/Manager.php';

TestPoint_Manager::compile('Имя_Будущего_Класса', 'Путь/до/конфига/onload.json', 'базовый/путь/до/трейтов/');
```

В конфиге должна быть секция "traits", содержащая имена трейтов, которые должны быть включены в класс. 
Например:

```
"traits" :
    [
        "TP",
        "Config",
        "File",
        "Log_File_Json",
        "Test",
        "PHPUnit",
        "Mode"
    ]
```

### Результат

Имя_Будущего_Класса.php

Далее, используем как в инструкции к TestPoint: https://github.com/Sett/testpoint/blob/master/README.md
