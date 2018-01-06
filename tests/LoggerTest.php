<?php
/**
 * PHP library to create logs easily and store them in Json format.
 *
 * @author    Josantonius <hello@josantonius.com>
 * @copyright 2017 - 2018 (c) Josantonius - PHP-Logger
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/Josantonius/PHP-Logger
 * @since     1.1.2
 */
namespace Josantonius\Logger;

use PHPUnit\Framework\TestCase;

/**
 * Tests class for Logger library.
 */
final class LoggerTest extends TestCase
{
    /**
     * Logger instance.
     *
     * @since 1.1.4
     *
     * @var object
     */
    protected $Logger;

    /**
     * Set up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->Logger = new Logger;

        $this->ROOT = $_SERVER['DOCUMENT_ROOT'];
        $this->CSS = 'http://' . $_SERVER['SERVER_NAME'] . '/css/';
        $this->JS = 'http://' . $_SERVER['SERVER_NAME'] . '/js/';
    }

    /**
     * Tear down.
     */
    public function tearDown()
    {
        parent::tearDown();

        $logger = $this->Logger;

        $logger::reset();

        if (file_exists($this->ROOT . '/log/logs.jsond')) {
            unlink($this->ROOT . '/log/logs.jsond');
        }
    }

    /**
     * Check if it is an instance of Logger.
     *
     * @since 1.1.4
     */
    public function testIsInstanceOfLogger()
    {
        $this->assertInstanceOf('Josantonius\Logger\Logger', $this->Logger);
    }

    /**
     * Start logging.
     */
    public function testStartLogging()
    {
        $this->assertContains(
            'Josantonius\Logger\Logger',
            get_class(
                new Logger
            )
        );
    }

    /**
     * Start logging with custom path.
     */
    public function testStartLoggingWithCustomPath()
    {
        $this->assertContains(
            'Josantonius\Logger\Logger',
            get_class(
                new Logger($this->ROOT . '/log/')
            )
        );
    }

    /**
     * Start logging with custom filename.
     */
    public function testStartLoggingWithCustomFilename()
    {
        $this->assertContains(
            'Josantonius\Logger\Logger',
            get_class(
                new Logger($this->ROOT . '/log/', 'logs')
            )
        );
    }

    /**
     * Start logging with custom logs number.
     */
    public function testStartLoggingWithCustomLogsNumber()
    {
        $this->assertContains(
            'Josantonius\Logger\Logger',
            get_class(
                new Logger($this->ROOT . '/log/', 'logs', 500)
            )
        );
    }

    /**
     * Start logging with custom user IP.
     */
    public function testStartLoggingWithCustomUserIP()
    {
        $this->assertContains(
            'Josantonius\Logger\Logger',
            get_class(
                new Logger($this->ROOT . '/log/', 'logs', 500, '158.80.84.144')
            )
        );
    }

    /**
     * Start logging deactivating some default states.
     */
    public function testStartLoggingDeactivatingSomeDefaultStates()
    {
        $states = [
            'global' => true,
            'success' => false,
            'join' => false,
            'info' => false,
            'warning' => false,
            'error' => true,
            'fatal' => false,
            'request' => false,
            'response' => false,
        ];

        $this->assertContains(
            'Josantonius\Logger\Logger',
            get_class(
                new Logger($this->ROOT . '/log/', 'logs', 500, '58.80.84.44', $states)
            )
        );
    }

    /**
     * Start logging deactivating all default states.
     */
    public function testStartLoggingDeactivatingAllDefaultStates()
    {
        $states = [
            'global' => false,
            'success' => true,
            'join' => true,
            'info' => true,
            'warning' => true,
            'error' => true,
            'fatal' => true,
            'request' => true,
            'response' => true,
        ];

        $this->assertContains(
            'Josantonius\Logger\Logger',
            get_class(
                new Logger($this->ROOT . '/log/', 'logs', 500, '58.80.84.44', $states)
            )
        );
    }

    /**
     * Start logging with custom states.
     */
    public function testStartLoggingWithCustomStates()
    {
        $states = [
            'global' => true,
            'custom-1' => true,
            'custom-2' => true,
            'custom-3' => false,
            'custom-4' => true,
        ];

        $this->assertContains(
            'Josantonius\Logger\Logger',
            get_class(
                new Logger($this->ROOT . '/log/', 'logs', 500, '58.80.84.44', $states)
            )
        );
    }

    /**
     * Reset parameters.
     */
    public function testResetParameters()
    {
        $logger = $this->Logger;

        $this->assertTrue($logger::reset());

        new Logger;
    }

    /**
     * Get number of logs added in the current section.
     */
    public function testAddedLogs()
    {
         $logger = new Logger;

        $this->assertInternalType(
            'int',
            $logger::added()
        );
    }

    /**
     * Get saved logs.
     */
    public function testGetSavedLogs()
    {
        $logger = new Logger;

        $this->assertInternalType(
            'array',
            $logger::get()
        );

        $this->assertTrue($logger::added() === 0);
    }

    /**
     * Save logs with default states.
     */
    public function testSaveLogsWithDefaultStates()
    {
        $logger = new Logger;

        $log = $logger::save('SUCCESS', 100, 'msg', __LINE__, __FILE__);
        $log &= $logger::save('JOIN', 200, 'msg', __LINE__, __FILE__);
        $log &= $logger::save('INFO', 300, 'msg', __LINE__, __FILE__);
        $log &= $logger::save('WARNING', 400, 'msg', __LINE__, __FILE__);
        $log &= $logger::save('ERROR', 500, 'msg', __LINE__, __FILE__);
        $log &= $logger::save('FATAL', 600, 'msg', __LINE__, __FILE__);
        $log &= $logger::save('REQUEST', 700, 'msg', __LINE__, __FILE__);
        $log &= $logger::save('RESPONSE', 800, 'msg', __LINE__, __FILE__);

        $this->assertInternalType('array', $logs = $logger::get());

        $this->assertTrue($logs[0]['type'] === 'success');
        $this->assertTrue($logs[1]['type'] === 'join');
        $this->assertTrue($logs[7]['type'] === 'response');

        $this->assertTrue($log === 1);

        $this->assertTrue($logger::added() === 8);
    }

    /**
     * Save logs with custom states.
     */
    public function testSaveLogsWithCustomStates()
    {
        $states = [
            'global' => true,
            'custom-1' => true,
            'custom-2' => true,
            'custom-3' => false,
            'custom-4' => true,
        ];

        $logger = new Logger($this->ROOT . '/log/', 'logs', 500, '58.80.84.44', $states);

        $log = $logger::save('CUSTOM-1', 100, 'msg', __LINE__, __FILE__);
        $log &= $logger::save('CUSTOM-2', 200, 'msg', __LINE__, __FILE__);
        $log &= $logger::save('CUSTOM-4', 400, 'msg', __LINE__, __FILE__);

        $this->assertTrue($log === 1);

        $this->assertFalse(
            $logger::save('CUSTOM-3', 300, 'msg', __LINE__, __FILE__)
        );

        $this->assertTrue($logger::added() === 3);

        $this->assertInternalType('array', $logs = $logger::get());

        $this->assertTrue($logs[0]['type'] === 'custom-1');
        $this->assertTrue($logs[1]['type'] === 'custom-2');
        $this->assertTrue($logs[2]['type'] === 'custom-4');
    }

    /**
     * Save logs with custom parameters.
     */
    public function testSaveLogsWithCustomParams()
    {
        $logger = new Logger;

        $params = [
            'id-user' => 68,
            'name-user' => 'Joe',
            'city' => 'Seville',
        ];

        $logger::save('SUCCESS', 100, 'msg', __LINE__, __FILE__, $params);

        $this->assertInternalType('array', $logs = $logger::get());

        $this->assertTrue($logs[0]['type'] === 'success');
        $this->assertTrue($logs[0]['id-user'] === 68);
        $this->assertTrue($logs[0]['name-user'] === 'Joe');
        $this->assertTrue($logs[0]['city'] === 'Seville');

        $this->assertTrue($logger::added() === 1);
    }

    /**
     * Save logs with custom states and without global state [FALSE].
     */
    public function testSaveLogsWithCustomStatesAndWithoutGlobal()
    {
        $logger = new Logger($this->ROOT . '/log/', 'logs', 500, '58.80.84.44', []);

        $this->assertFalse(
            $logger::save('CUSTOM-1', 300, 'msg', __LINE__, __FILE__)
        );

        $this->assertTrue($logger::added() === 0);
    }

    /**
     * Store logs.
     */
    public function testStoreLogs()
    {
        $logger = new Logger;

        $logger::save('SUCCESS', 100, 'msg', __LINE__, __FILE__);
        $logger::save('JOIN', 200, 'msg', __LINE__, __FILE__);
        $logger::save('INFO', 300, 'msg', __LINE__, __FILE__);
        $logger::save('WARNING', 400, 'msg', __LINE__, __FILE__);
        $logger::save('ERROR', 500, 'msg', __LINE__, __FILE__);
        $logger::save('FATAL', 600, 'msg', __LINE__, __FILE__);
        $logger::save('REQUEST', 700, 'msg', __LINE__, __FILE__);
        $logger::save('RESPONSE', 800, 'msg', __LINE__, __FILE__);

        $this->assertInternalType('array', $logs = $logger::get());

        $this->assertTrue($logs[0]['type'] === 'success');
        $this->assertTrue($logs[1]['type'] === 'join');
        $this->assertTrue($logs[7]['type'] === 'response');

        $this->assertTrue($logger::added() === 8);

        $this->assertTrue($logger::store());

        $this->assertFileExists($this->ROOT . '/log/logs.jsond');
    }

    /**
     * Store logs when no logs have been saved.
     */
    public function testStoreNotSavedLogs()
    {
        $logger = new Logger;

        $this->assertTrue($logger::added() === 0);

        $this->assertFalse($logger::store());
    }

    /**
     * Define directory for scripts and get url from file.
     */
    public function testLoadScript()
    {
        $logger = $this->Logger;

        $this->assertContains(
            $this->JS . 'logger.min-',
            $script = $logger::script($this->JS)
        );

        $this->assertFileExists($this->ROOT . '/js/' . basename($script));
    }

    /**
     * Define directory for styles and get url from file.
     */
    public function testLoadStyles()
    {
        $logger = $this->Logger;

        $this->assertContains(
            $this->CSS . 'logger.min-',
            $style = $logger::style($this->CSS)
        );

        $this->assertFileExists($this->ROOT . '/css/' . basename($style));
    }

    /**
     * Store logs when no logs have been saved.
     */
    public function testRenderLogs()
    {
        $logger = new Logger;

        $logger::save('SUCCESS', 100, 'msg', __LINE__, __FILE__);
        $logger::save('JOIN', 200, 'msg', __LINE__, __FILE__);
        $logger::save('INFO', 300, 'msg', __LINE__, __FILE__);

        printf('<link href="%s">', $logger::style($this->CSS));

        printf('<script src="%s">', $logger::script($this->JS));

        $this->assertTrue($logger::render());

        $this->expectOutputRegex(
            '[<link href="http://josantonius.com/css/logger.min-*]'
        );

        $this->expectOutputRegex(
            '[<script src="http://josantonius.com/js/logger.min-*]'
        );

        $this->expectOutputRegex(
            '[<div class="jst-logs">]'
        );

        $this->expectOutputRegex(
            '[<p class="jst-log">]'
        );

        $this->expectOutputRegex(
            '[<div class="jst-clear"></div>]'
        );
    }
}
