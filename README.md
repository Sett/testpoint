Test Point
=========

Gain points for tests

***[Ru]***

Игрофикация юнит тестирования кода на PHP (дописать до нужного языка - раз плюнуть).

Смысл очень прост:

Если все кейсы теста проходят успешно - разработчик получает по 1 очку за каждый кейс.
Если какой-то кейс валится - разработчик теряет по 1 очку за каждый отвалившийся кейс (при этом за удачные кейсы, разработчик в этом случае, ничего не получает).

На этапе самотестирования (т.е. это до альфа-версии альфа-версии) результаты скалдываются в json-файлик.

***[Как это использовать]***

Очень просто, формиурете список тестов и скармливаете его классу:

<?php

$testPoint = new TestPoint('developer name', ['path/to/test/1', 'path/to/test/2']);

// Или указываем директорию, где лежат тесты (поддиректории поддерживаются):

// $testPoint = new TestPoint('sett', 'path/to/tests');

Как видно, использовать можно по крону или любому таймеру, какой у вас используется, например, при CI.
Результаты сейчас выглядят примерно так:

<?php

$testPoint = new TestPoint('sett', ['Mytest']);

Result:

  {
    "sett":
    {
      "points":8,
      "log":
      [
        {"status":"WIN","datetime":"2013-10-16 17:21:47","points":"3"},
        {"status":"WIN","datetime":"2013-10-16 17:23:37","points":"3"},
        {"status":"lose","datetime":"2013-10-16 17:33:26","points":"1","possible":"3"},
        {"status":"WIN","datetime":"2013-10-16 17:33:32","points":"3"}
      ]
    }
  }

