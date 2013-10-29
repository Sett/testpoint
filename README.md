Test Point
=========

Gain points for tests

## [Ru]

Игрофикация юнит тестирования кода на PHP (дописать до нужного языка - раз плюнуть).

Смысл очень прост:

Если все кейсы теста проходят успешно - разработчик получает по 1 очку за каждый кейс.
Если какой-то кейс валится - разработчик теряет по 1 очку за каждый отвалившийся кейс (при этом за удачные кейсы, разработчик в этом случае, ничего не получает).

На этапе самотестирования (т.е. это до альфа-версии альфа-версии) результаты скалдываются в json-файлик.

## [Как это использовать]

Очень просто, формиурете список тестов и скармливаете его классу:

```
<?php

$testPoint = new TestPoint('developer name', ['path/to/test/1', 'path/to/test/2']);

// Или указываем директорию, где лежат тесты (поддиректории поддерживаются):
// $testPoint = new TestPoint('sett', 'path/to/tests');
```

Как видно, использовать можно по крону или любому таймеру, какой у вас используется, например, при CI.
Результаты сейчас выглядят примерно так:

<?php

``` $testPoint = new TestPoint('sett', ['path/to/Mytest.php']);```

Result:
<pre>
  {
    "sett":
    {
      "points":8,
      "log":
      [
        {"status":"WIN","datetime":"текущая дата","points":"3"},
        {"status":"WIN","datetime":"текущая дата","points":"3"},
        {"status":"lose","datetime":"текущая дата","points":"1","possible":"3"},
        {"status":"WIN","datetime":"текущая дата","points":"3"}
      ]
    }
  }
</pre>

## [Try me]

Самый простой способ попробовать TestPoint:

* Клонируем этот репозиторий.
* Запускаем tryme.php: "`php tryme.php`".

Если у вас установлен PHPUnit и есть рнр >= 5.4, то после запуска у вас:

* В консоли отобразится ход "игры":

```
/var/www/testpoint$ php tryme.php 

  =====| Constructing TestPoint for "sett" |=====

    ===| Applying config sections |===
    
 - log
 - store
 - mode
 - test

Tests for playing: /var/www/testPoint/tests/TestPointTest.php

    ===| Start test(s) |===
  
Run /var/www/testPoint/tests/TestPointTest.php
Gained 3 point(s)
Save results into records.json

Logging testing output into log.json

```

* Должен появиться файлик `records.json`: 


```
{
    "correct test":
    {
        "points":1,
        "log":[{"status":"WIN","datetime":"<текущая дата>","points":"1"}]
    },
    "failed test":
    {
        "points":-1,"log":[{"status":"lose","datetime":"<текущая дата>","points":1,"possible":"1"}]
    },
    "sett":
    {
        "points":3,
        "log":[{"status":"WIN","datetime":"<текущая дата>","points":"3"}]
    }
}
```

* Должен появиться лог `log.json`:

```
[<текущая дата>]
PHPUnit 3.6.10 by Sebastian Bergmann.

.
=====| Constructing TestPoint for "correct test" |=====

===| Applying config sections |===

 - log
 - store
 - mode
 - test
 

Tests for playing: /var/www/testpoint/tests/TestExample

===| Start test(s) |===

Run /var/www/testpoint/tests/TestExample
Gained 1 point(s)
Save results into records.json

.
=====| Constructing TestPoint for "failed test" |=====
Tests for playing: /var/www/testpoint/tests/TestIncorrect

===| Start test(s) |===
Run /var/www/testPoint/tests/TestIncorrect
Losing 1 point(s)
Save results into records.json

.

Time: 0 seconds, Memory: 2.25Mb

OK (3 tests, 0 assertions)


```
