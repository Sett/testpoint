Test Point
=========

Gain points for tests

## http://tpsett.wordpress.com

## [Ru]

Игрофикация юнит тестирования кода на PHP (дописать до нужного языка - раз плюнуть).

Смысл очень прост:

Если все кейсы теста проходят успешно - разработчик получает по 1 очку за каждый кейс.
Если какой-то кейс валится - разработчик теряет по 1 очку за каждый отвалившийся кейс (при этом за удачные кейсы, разработчик в этом случае, ничего не получает).

На этапе самотестирования результаты скалдываются в базу MySQL.

## [Как это использовать]

Очень просто, формиурете список тестов и скармливаете его классу:

```
<?php

$testPoint = new TestPoint('developer name', ['path/to/test/1', 'path/to/test/2']);

// Или указываем директорию, где лежат тесты (поддиректории поддерживаются):
// $testPoint = new TestPoint('sett', 'path/to/tests');
```

Как видно, использовать можно по крону или любому таймеру, какой у вас используется, например, при CI.

На текущем этапе сразу готового класса TestPoint у вас нет - его нужно собрать. Для этого используется Менеджер сборки, подробнее о нём вы можете прочитать [здесь](https://github.com/Sett/testpoint/wiki/TestPoint_Manager).

## [Man]

Самый простой способ попробовать TestPoint:

* Клонируем этот репозиторий.
* Запускаем man.php: "`php man.php`". Он лежит в папке `example`.

Если у вас установлен PHPUnit и есть рнр >= 5.4, то после запуска у вас:

* В консоли отобразится ход "игры":

```
/var/www/testpoint$ php example/man.php 

<?php

require_once 'modules/TestPoint.php';
require_once 'modules/Config/Log.php';
require_once 'modules/Config/Mode.php';
require_once 'modules/Config/PHPUnit.php';
require_once 'modules/Config/Store.php';
require_once 'modules/Config/System.php';
require_once 'modules/Config/Talk.php';
require_once 'modules/Config/Test.php';
require_once 'modules/Config/Event.php';
require_once 'modules/Config.php';
require_once 'modules/File.php';
require_once 'modules/lib/Mysql.php';
require_once 'modules/Log/Db/Mysql.php';
require_once 'modules/Test.php';
require_once 'modules/ArrayLib.php';
require_once 'modules/PHPUnit/Analyse.php';
require_once 'modules/PHPUnit.php';
require_once 'modules/Talk/Console.php';
require_once 'modules/Talk.php';
require_once 'modules/Event.php';

class TestManager
{
        use TestPoint, 
                Config_Log, 
                Config_Mode, 
                Config_PHPUnit, 
                Config_Store, 
                Config_System, 
                Config_Talk, 
                Config_Test, 
                Config_Event, 
                Config, 
                File, 
                Log_Db_Mysql, 
                Test, 
                ArrayLib, 
                PHPUnit_Analyse, 
                PHPUnit, 
                Talk_Console, 
                Talk, 
                Event;
}

  =====| System information: TestPoint v.0.0.start.5 | 14:52:49 |=====


  =====| Constructing TestPoint for "sett" |=====


    ===| Applying config sections |===

  - talk
  - log
  - event
  - system
  - store
  - test
  - phpunit

 Tests for playing: 

 in /var/www/testPoint/testpoint/tests/

  =====| Start test(s) |=====

 Run /var/www/testPoint/testpoint/tests/

    ===| PHPUnit |===

 Flags:
        --coverage-html pu-coverage-php.html
        --testdox-html pu-doc.html
        --process-isolation
        --bootstrap path/to/bootstrap

    ===| Results |===

 Gained 36 point(s)
 Now 36 points
 Save results into test-tp: test_results

 Rised event "testing output"

  =====| Finish in 12 second(s) |=====

```

* Должен появиться лог `log.txt`:

```
[<текущая дата>]
PHPUnit 3.6.10 by Sebastian Bergmann.

.

Time: 0 seconds, Memory: 2.25Mb

OK (3 tests, 0 assertions)


```
