# PHP Logger library

[![Latest Stable Version](https://poser.pugx.org/josantonius/logger/v/stable)](https://packagist.org/packages/josantonius/logger) [![Total Downloads](https://poser.pugx.org/josantonius/logger/downloads)](https://packagist.org/packages/josantonius/logger) [![Latest Unstable Version](https://poser.pugx.org/josantonius/logger/v/unstable)](https://packagist.org/packages/josantonius/logger) [![License](https://poser.pugx.org/josantonius/logger/license)](https://packagist.org/packages/josantonius/logger)

[Spanish version](README-ES.md)

Librería php para crear logs fácilmente y almacenarlos en formato Json.

---

- [Instalación](#instalación)
- [Requisitos](#requisitos)
- [Cómo empezar y ejemplos](#cómo-empezar-y-ejemplos)
- [Métodos disponibles](#métodos-disponibles)
- [Uso](#uso)
- [Tests](#tests)
- [Manejador de excepciones](#manejador-de-excepciones)
- [Contribuir](#contribuir)
- [Repositorio](#repositorio)
- [Autor](#autor)
- [Licencia](#licencia)

---

### Instalación 

La mejor forma de instalar esta extensión es a través de [composer](http://getcomposer.org/download/).

Para instalar PHP Logger library, simplemente escribe:

    $ composer require Josantonius/Logger

### Requisitos

Esta ĺibrería es soportada por versiones de PHP 5.6 o superiores y es compatible con versiones de HHVM 3.0 o superiores.

### Cómo empezar y ejemplos

Para utilizar esta librería, simplemente:

```php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Logger\Logger;
```
### Métodos disponibles

Métodos disponibles en esta librería:

```php
Logger::save();
Logger::storeLogs();
Logger->shutdown();
```
### Uso

Ejemplo de uso para esta librería:

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

Para utilizar la clase de [pruebas](tests), simplemente:

```php
<?php
$loader = require __DIR__ . '/vendor/autoload.php';

$loader->addPsr4('Josantonius\\Logger\\Tests\\', __DIR__ . '/vendor/josantonius/logger/tests');

use Josantonius\Logger\Tests\LoggerTest;
```
Métodos de prueba disponibles en esta librería:

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

### Manejador de excepciones

Esta librería utiliza [control de excepciones](src/Exception) que puedes personalizar a tu gusto.
### Contribuir
1. Comprobar si hay incidencias abiertas o abrir una nueva para iniciar una discusión en torno a un fallo o función.
1. Bifurca la rama del repositorio en GitHub para iniciar la operación de ajuste.
1. Escribe una o más pruebas para la nueva característica o expón el error.
1. Haz cambios en el código para implementar la característica o reparar el fallo.
1. Envía pull request para fusionar los cambios y que sean publicados.

Esto está pensado para proyectos grandes y de larga duración.

### Repositorio

Los archivos de este repositorio se crearon y subieron automáticamente con [Reposgit Creator](https://github.com/Josantonius/BASH-Reposgit).

### Autor

Mantenido por [Josantonius](https://github.com/Josantonius/).

### Licencia

Este proyecto está licenciado bajo la **licencia MIT**. Consulta el archivo [LICENSE](LICENSE) para más información.