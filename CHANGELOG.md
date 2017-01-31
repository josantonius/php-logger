# CHANGELOG

## 1.1.0 - 2017-01-30
* Compatible with PHP 5.6 or higher.

## 1.0.0 - 2017-01-30
* Compatible only with PHP 7.0 or higher. In the next versions, the library will be modified to make it compatible with PHP 5.6 or higher.

## 1.0.0 - 2017-01-21
* Added `Josantonius\Logger\Logger` class.
* Added `Josantonius\Logger\Logger->__construct()` method.
* Added `Josantonius\Logger\Logger->_getLogs()` method.
* Added `Josantonius\Logger\Logger::save()` method.
* Added `Josantonius\Logger\Logger::storeLogs()` method.
* Added `Josantonius\Logger\Logger::_validateLogsNumber()` method.
* Added `Josantonius\Logger\Logger->shutdown()` method.

## 1.0.0 - 2017-01-21
* Added `Josantonius\Logger\Exception\LoggerException` class.
* Added `Josantonius\Logger\Exception\Exceptions` abstract class.
* Added `Josantonius\Logger\Exception\LoggerException->__construct()` method.

## 1.0.0 - 2017-01-21
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
