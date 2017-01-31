# PHP Logger library

[![Latest Stable Version](https://poser.pugx.org/josantonius/logger/v/stable)](https://packagist.org/packages/josantonius/logger) [![Total Downloads](https://poser.pugx.org/josantonius/logger/downloads)](https://packagist.org/packages/josantonius/logger) [![Latest Unstable Version](https://poser.pugx.org/josantonius/logger/v/unstable)](https://packagist.org/packages/josantonius/logger) [![License](https://poser.pugx.org/josantonius/logger/license)](https://packagist.org/packages/josantonius/logger)

[Spanish version](README-ES.md)

Php library to create logs easily and store them in Json format.

---

- [Installation](#installation)
- [Requirements](#requirements)
- [Quick Start and Examples](#quick-start-and-examples)
- [Available Methods](#available-methods)
- [Usage](#usage)
- [Tests](#tests)
- [Exception Handler](#exception-handler)
- [Contribute](#contribute)
- [Repository](#repository)
- [Author](#author)
- [Licensing](#licensing)

---

### Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

To install PHP Logger library, simply:

    $ composer require Josantonius/Logger

### Requirements

This library is supported by PHP versions 5.6 or higher and is compatible with HHVM versions 3.0 or higher.

### Quick Start and Examples

To use this class, simply:

```php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Logger\Logger;
```
### Available Methods

Available methods in this library:

```php
Logger::save();
Logger::storeLogs();
```
### Usage

Example of use for this library:

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Logger\Logger;

new Logger();

Logger::save('JOIN',    800, 100, 'Your message here', __LINE__, __FILE__);
Logger::save('INFO',    801, 200, 'Your message here', __LINE__, __FILE__);
Logger::save('WARNING', 802, 300, 'Your message here', __LINE__, __FILE__);
Logger::save('ERROR',   803, 400, 'Your message here', __LINE__, __FILE__);
Logger::save('FATAL',   804, 500, 'Your message here', __LINE__, __FILE__);

Logger::storeLogs();

echo '<pre>'; var_dump(Logger::$logs); echo '</pre>';

/*
array(1) {
  [0]=>
  array(14) {
    ["ip"]=>
    string(3) "158.54.12.100"
    ["uri"]=>
    string(5) "/folder/"
    ["referer"]=>
    string(7) "http://www.referer.es/"
    ["remote-port"]=>
    int(47290)
    ["ip-server"]=>
    string(3) "188.254.112.200"
    ["user-agent"]=>
    string(133) "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/5.36 (KHTML, like Gecko) Ubuntu Chromium/55.0.23.87 Chrome/55.0.23.87 Safari/5.36"
    ["type"]=>
    string(4) "join"
    ["state"]=>
    int(800)
    ["code"]=>
    string(3) "100"
    ["message"]=>
    string(17) "Visit the page"
    ["line"]=>
    int(572)
    ["file"]=>
    string(44) "/var/www/localhost/public_html/folder/index.php"
    ["hour"]=>
    string(8) "20:58:18"
    ["date"]=>
    string(10) "2017-01-21"
  }
}
*/
```

### Tests 

To use the [test](tests) class, simply:

```php
<?php
$loader = require __DIR__ . '/vendor/autoload.php';

$loader->addPsr4('Josantonius\\Logger\\Tests\\', __DIR__ . '/vendor/josantonius/logger/tests');

use Josantonius\Logger\Tests\LoggerTest;

```
Available test methods in this library:

```php
LoggerTest->testSaveLog();
LoggerTest->testSaveLogWithFilepath();
LoggerTest->testSaveLogWithLimitLogsNumber();
LoggerTest->testSaveLogWithUserIP();
LoggerTest->testSaveLogWithUserCustomStates();
LoggerTest->testSaveLogWithUserCustomParams();
LoggerTest->testDisableLogs();
LoggerTest->testDisableLogsByState();
LoggerTest->testGetLogs();
LoggerTest->testGetLogsFromCustomPath();
LoggerTest->testExceptionCouldCreatePath();
```

### Exception Handler

This library uses [exception handler](src/Exception) that you can customize.
### Contribute
1. Check for open issues or open a new issue to start a discussion around a bug or feature.
1. Fork the repository on GitHub to start making your changes.
1. Write one or more tests for the new feature or that expose the bug.
1. Make code changes to implement the feature or fix the bug.
1. Send a pull request to get your changes merged and published.

This is intended for large and long-lived objects.

### Repository

All files in this repository were created and uploaded automatically with [Reposgit Creator](https://github.com/Josantonius/BASH-Reposgit).

### Author

Maintained by [Josantonius](https://github.com/Josantonius/).

### Licensing

This project is licensed under **MIT license**. See the [LICENSE](LICENSE) file for more info.