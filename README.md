# PHP Logger library

[![Latest Stable Version](https://poser.pugx.org/josantonius/Logger/v/stable)](https://packagist.org/packages/josantonius/Logger)
 [![License](https://poser.pugx.org/josantonius/Logger/license)](LICENSE)

[Spanish version](README-ES.md)

Php library to create logs easily and store them in Json format.

---

- [Requirements](#requirements)
- [Installation](#installation)
- [Available Methods](#available-methods)
- [Quick Start](#quick-start)
- [Available Methods](#available-methods)
- [Usage](#usage)
- [Tests](#tests)
- [Sponsor](#Sponsor)
- [License](#license)

---

## Requirements

This library is supported by **PHP versions 5.6** or higher and is compatible with **HHVM versions 3.0** or higher.

## Installation

The preferred way to install this extension is through [Composer](http://getcomposer.org/download/).

To install **PHP Logger library**, simply:

    composer require Josantonius/Logger

The previous command will only install the necessary files, if you prefer to **download the entire source code** you can use:

    composer require Josantonius/Logger --prefer-source

You can also **clone the complete repository** with Git:

  $ git clone <https://github.com/Josantonius/PHP-Logger.git>

Or **install it manually**:

[Download Logger.php](https://raw.githubusercontent.com/Josantonius/PHP-Logger/master/src/Logger.php):

    wget https://raw.githubusercontent.com/Josantonius/PHP-Logger/master/src/Logger.php

[Download Json.php](https://raw.githubusercontent.com/Josantonius/PHP-Json/master/src/Json.php):

    wget https://raw.githubusercontent.com/Josantonius/PHP-Json/master/src/Json.php

## Images

![image](resources/logger-1.png)
![image](resources/logger-2.png)
![image](resources/logger-3.png)
![image](resources/logger-4.png)
![image](resources/logger-5.png)

## Available Methods

Available methods in this library:

### - Initiator for site debug management

```php
new Logger($path, $filename, $logNumber, $ip, $states);
```

| Atttribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $path | Path name to save file with logs. | string | No | null |
| $filename | JSON file name that will save the logs. | string | No | null |
| $logNumber | Maximum number of logs to save to file. | int | No | 200 |
| $ip | If you want to get to another library. | string | No | null |
| $states | Different states for logs. | array | No | null |

**# Return** (void)

### - Save log line

```php
Logger::save($type, $code, $msg, $line, $file, $data);
```

| Atttribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $type | Error type or warning. | string | Yes | |
| $code | HTTP response status code. | int | Yes | |
| $message | Message. | string | Yes | |
| $line | Line from which the save is executed. | int | Yes | |
| $file | Filepath from which the method is called. | string | Yes | |
| $data | Extra custom parameters. | array | No | 0 |

**# Return** (boolean)

### - Save logs to Json file

```php
Logger::store();
```

**# Return** (boolean)

### - Get saved logs

```php
Logger::get();
```

**# Return** (array) → logs saved

### - Define directory for scripts and get url from file

```php
Logger::script($url);
```

| Atttribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $url | File url. | string | Yes | |

**# Return** (string) → file url

### - Define directory for styles and get url from file

```php
Logger::style($url);
```

| Atttribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $url | File url. | string | Yes | |

**# Return** (string) → file url

### - Get number of logs added in the current section

```php
Logger::added();
```

**# Return** (int) → logs added in the current section

### - Display logger section

```php
Logger::render();
```

**# Return** (boolean true)

### - Reset parameters

```php
Logger::reset();
```

**# Return** (boolean true)

## Quick Start

To use this library with **Composer**:

```php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Logger\Logger;
```

Or If you installed it **manually**, use it:

```php
require_once __DIR__ . '/Logger.php';
require_once __DIR__ . '/Json.php';

use Josantonius\Logger\Logger;
```

## Usage

Example of use for this library:

### - Basic example

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Logger\Logger;

new Logger();

Logger::save('SUCCESS',  100, 'msg', __LINE__, __FILE__);
Logger::save('JOIN',     200, 'msg', __LINE__, __FILE__);
Logger::save('INFO',     300, 'msg', __LINE__, __FILE__);
Logger::save('WARNING',  400, 'msg', __LINE__, __FILE__);
Logger::save('ERROR',    500, 'msg', __LINE__, __FILE__);
Logger::save('FATAL',    600, 'msg', __LINE__, __FILE__);
Logger::save('REQUEST',  700, 'msg', __LINE__, __FILE__);
Logger::save('RESPONSE', 800, 'msg', __LINE__, __FILE__);

Logger::storeLogs();
```

### - Advanced example

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Logger\Logger;

$states  = [

  'global'    => true,
  'exception' => true,
  'error'     => false,
  'notice'    => false,
  'fatal'     => true,
];

new Logger('/logger/', 'logs', 600, '58.80.84.44', $states);

Logger::save('EXCEPTION', 400, 'msg', __LINE__, __FILE__);
Logger::save('ERROR' ,    402, 'msg', __LINE__, __FILE__);
Logger::save('NOTICE',    100, 'msg', __LINE__, __FILE__);

$params = [

  'id-user'   => 68,
  'name-user' => 'Joe'
]; 
        
Logger::save('FATAL, 500, 'msg', __LINE__, __FILE__, $params);

Logger::storeLogs();

echo 'Logs added: ' . Logger::added();

echo 'Logs added: ' . count(Logger::get);

printf('<link href="%s">', Logger::style('http://site.com/public/css/'));

printf('<script src="%s">', Logger::script('http://site.com/public/js/'));

Logger::render();
```

## Tests

To run [tests](tests) you just need [composer](http://getcomposer.org/download/) and to execute the following:

    git clone https://github.com/Josantonius/PHP-Logger.git
    
    cd PHP-Logger

    composer install

Run unit tests with [PHPUnit](https://phpunit.de/):

    composer phpunit

Run [PSR2](http://www.php-fig.org/psr/psr-2/) code standard tests with [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer):

    composer phpcs

Run [PHP Mess Detector](https://phpmd.org/) tests to detect inconsistencies in code style:

    composer phpmd

Run all previous tests:

    composer tests

## Sponsor

If this project helps you to reduce your development time,
[you can sponsor me](https://github.com/josantonius#sponsor) to support my open source work :blush:

## License

This repository is licensed under the [MIT License](LICENSE).

Copyright © 2017-2022, [Josantonius](https://github.com/josantonius#contact)
