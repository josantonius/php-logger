# CHANGELOG

## 1.1.4 - 2017-11-09

* Implemented `PHP Mess Detector` to detect inconsistencies in code styles.

* Implemented `PHP Code Beautifier and Fixer` to fixing errors automatically.

* Implemented `PHP Coding Standards Fixer` to organize PHP code automatically according to PSR standards.

## 1.1.3 - 2017-11-02

* Implemented `PSR-4 autoloader standard` from all library files.

* Implemented `PSR-2 coding standard` from all library PHP files.

* Implemented `PHPCS` to ensure that PHP code complies with `PSR2` code standards.

* Implemented `Codacy` to automates code reviews and monitors code quality over time.

* Implemented `Codecov` to coverage reports.

* Added `Logger/phpcs.ruleset.xml` file.

* Deleted `Logger/src/bootstrap.php` file.

* Deleted `Logger/tests/bootstrap.php` file.

* Deleted `Logger/vendor` folder.

* Changed `Josantonius\Logger\Test\LoggerTest` class to  `Josantonius\Logger\LoggerTest` class.


## 1.1.2 - 2017-10-16

* Unit tests supported by `PHPUnit` were added.

* The repository was synchronized with `Travis CI` to implement continuous integration.

* Gulp was added to the project for task automation.

* Deleted `Josantonius\Logger\Exception\LoggerException` class.
* Deleted `Josantonius\Logger\Exception\Exceptions` abstract class.
* Deleted `Josantonius\Logger\Exception\LoggerException->__construct()` method.
* Deleted `Josantonius\Logger\Logger::storeLogs()` method.

* Deleted `Josantonius\Logger\Logger->_getLogs()` method.

* Added `Josantonius\Logger\Logger->_setServerInfo()` method.
* Added `Josantonius\Logger\Logger->_setFilePath()` method.
* Added `Josantonius\Logger\Logger->_setStates()` method.
* Added `Josantonius\Logger\Logger::_setLogInfo()` method.
* Added `Josantonius\Logger\Logger::get()` method.
* Added `Josantonius\Logger\Logger::style()` method.
* Added `Josantonius\Logger\Logger::script()` method.
* Added `Josantonius\Logger\Logger::render()` method.
* Added `Josantonius\Logger\Logger::_setFile()` method.
* Added `Josantonius\Logger\Logger::store()` method.
* Added `Josantonius\Logger\Logger::added()` method.
* Added `Josantonius\Logger\Logger::reset()` method.

* Deleted `Josantonius\Logger\Tests\LoggerTest` class.
* Deleted `Josantonius\Logger\Tests\LoggerTest->testSaveLog()` method.
* Deleted `Josantonius\Logger\Tests\LoggerTest->testSaveLogWithFilepath()` method.
* Deleted `Josantonius\Logger\Tests\LoggerTest->testSaveLogWithLimitLogsNumber()` method.
* Deleted `Josantonius\Logger\Tests\LoggerTest->testSaveLogWithUserIP()` method.
* Deleted `Josantonius\Logger\Tests\LoggerTest->testSaveLogWithUserCustomStates()` method.
* Deleted `Josantonius\Logger\Tests\LoggerTest->testSaveLogWithUserCustomParams()` method.
* Deleted `Josantonius\Logger\Tests\LoggerTest->testDisableLogs()` method.
* Deleted `Josantonius\Logger\Tests\LoggerTest->testDisableLogsByState()` method.
* Deleted `Josantonius\Logger\Tests\LoggerTest->testGetLogs()` method.
* Deleted `Josantonius\Logger\Tests\LoggerTest->testGetLogsFromCustomPath()` method.
* Deleted `Josantonius\Logger\Tests\LoggerTest->testExceptionCouldCreatePath()` method.

* Added `Josantonius\Logger\Test\LoggerTest` class.
* Added `Josantonius\Logger\Test\LoggerTest->setUp()` method.
* Added `Josantonius\Logger\Test\LoggerTest->testStartLogging()` method.
* Added `Josantonius\Logger\Test\LoggerTest->testStartLoggingWithCustomPath()` method.
* Added `Josantonius\Logger\Test\LoggerTest->testStartLoggingWithCustomFilename()` method.
* Added `Josantonius\Logger\Test\LoggerTest->testStartLoggingWithCustomLogsNumber()` method.
* Added `Josantonius\Logger\Test\LoggerTest->testStartLoggingWithCustomUserIP()` method.
* Added `Josantonius\Logger\Test\LoggerTest->testStartLoggingDeactivatingSomeDefaultStates()` method.
* Added `Josantonius\Logger\Test\LoggerTest->testStartLoggingDeactivatingAllDefaultStates()` method.
* Added `Josantonius\Logger\Test\LoggerTest->testStartLoggingWithCustomStates()` method.
* Added `Josantonius\Logger\Test\LoggerTest->testResetParameters()` method.
* Added `Josantonius\Logger\Test\LoggerTest->testAddedLogs()` method.
* Added `Josantonius\Logger\Test\LoggerTest->testGetSavedLogs()` method.
* Added `Josantonius\Logger\Test\LoggerTest->testSaveLogsWithDefaultStates()` method.
* Added `Josantonius\Logger\Test\LoggerTest->testSaveLogsWithCustomStates()` method.
* Added `Josantonius\Logger\Test\LoggerTest->testSaveLogsWithCustomParams()` method.
* Added `Josantonius\Logger\Test\LoggerTest->testSaveLogsWithCustomStatesAndWithoutGlobal()` method.
* Added `Josantonius\Logger\Test\LoggerTest->testStoreLogs()` method.
* Added `Josantonius\Logger\Test\LoggerTest->testStoreNotSavedLogs()` method.
* Added `Josantonius\Logger\Test\LoggerTest->testLoadScript()` method.
* Added `Josantonius\Logger\Test\LoggerTest->testLoadStyles()` method.
* Added `Josantonius\Logger\Test\LoggerTest->testRenderLogs()` method.
* Added `Josantonius\Logger\Test\LoggerTest->tearDown()` method.

* Added `Josantonius\Json` library.

* Added `Logger/public/css/logger.min.css` file.
* Added `Logger/public/css/source/logger.css` file.

* Added `Logger/public/js/logger.sass` file.
* Added `Logger/public/js/partials/_colors.sass` file.
* Added `Logger/public/js/partials/_global.sass` file.

* Added `Logger/public/css/source/logger.css` file.
* Added `Logger/public/css/source/logger.css` file.

* Added `Logger/public/template/logger.php` file.

## 1.1.1 - 2017-03-18

* Some files were excluded from download and comments and readme files were updated.

## 1.1.0 - 2017-01-30

* Compatible with PHP 5.6 or higher.

## 1.0.0 - 2017-01-30

* Compatible only with PHP 7.0 or higher. In the next versions, the library will be modified to make it compatible with PHP 5.6 or higher.

* Added `Josantonius\Logger\Logger` class.
* Added `Josantonius\Logger\Logger->__construct()` method.
* Added `Josantonius\Logger\Logger->_getLogs()` method.
* Added `Josantonius\Logger\Logger::save()` method.
* Added `Josantonius\Logger\Logger::storeLogs()` method.
* Added `Josantonius\Logger\Logger::_validateLogsNumber()` method.
* Added `Josantonius\Logger\Logger->shutdown()` method.

* Added `Josantonius\Logger\Exception\LoggerException` class.
* Added `Josantonius\Logger\Exception\Exceptions` abstract class.
* Added `Josantonius\Logger\Exception\LoggerException->__construct()` method.

* Added `Josantonius\Logger\Tests\LoggerTest` class.
* Added `Josantonius\Logger\Tests\LoggerTest->testSaveLog()` method.
* Added `Josantonius\Logger\Tests\LoggerTest->testSaveLogWithFilepath()` method.
* Added `Josantonius\Logger\Tests\LoggerTest->testSaveLogWithLimitLogsNumber()` method.
* Added `Josantonius\Logger\Tests\LoggerTest->testSaveLogWithUserIP()` method.
* Added `Josantonius\Logger\Tests\LoggerTest->testSaveLogWithUserCustomStates()` method.
* Added `Josantonius\Logger\Tests\LoggerTest->testSaveLogWithUserCustomParams()` method.
* Added `Josantonius\Logger\Tests\LoggerTest->testDisableLogs()` method.
* Added `Josantonius\Logger\Tests\LoggerTest->testDisableLogsByState()` method.
* Added `Josantonius\Logger\Tests\LoggerTest->testGetLogs()` method.
* Added `Josantonius\Logger\Tests\LoggerTest->testGetLogsFromCustomPath()` method.
* Added `Josantonius\Logger\Tests\LoggerTest->testExceptionCouldCreatePath()` method.