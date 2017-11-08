<?php
/**
 * PHP library to create logs easily and store them in Json format.
 *
 * @author    Josantonius <hello@josantonius.com>
 * @copyright 2017 (c) Josantonius - PHP-Logger
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/Josantonius/PHP-Logger
 * @since     1.1.2
 */
namespace Josantonius\Logger;

use PHPUnit\Framework\TestCase;

/**
 * Tests class for Logger library.
 *
 * @since 1.1.2
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
     *
     * @since 1.1.2
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
     *
     * @since 1.1.2
     */
    public function tearDown()
    {
        parent::tearDown();

        $this->Logger->reset();

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
        $actual = $this->Logger;
        $this->assertInstanceOf('Josantonius\Logger\Logger', $actual);
    }

    /**
     * Start logging.
     *
     * @since 1.1.2
     */
    public function testStartLogging()
    {
        $this->assertContains(
            'Josantonius\Logger\Logger',
            get_class(
                new Logger()
            )
        );
    }

    /**
     * Start logging with custom path.
     *
     * @since 1.1.2
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
     *
     * @since 1.1.2
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
     *
     * @since 1.1.2
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
     *
     * @since 1.1.2
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
     *
     * @since 1.1.2
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
     *
     * @since 1.1.2
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
     *
     * @since 1.1.2
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
     *
     * @since 1.1.2
     */
    public function testResetParameters()
    {
        $this->assertTrue($this->Logger->reset());

        new Logger();
    }

    /**
     * Get number of logs added in the current section.
     *
     * @since 1.1.2
     */
    public function testAddedLogs()
    {
        new Logger();

        $this->assertInternalType(
            'int',
            $this->Logger->added()
        );
    }

    /**
     * Get saved logs.
     *
     * @since 1.1.2
     */
    public function testGetSavedLogs()
    {
        new Logger();

        $this->assertInternalType(
            'array',
            $this->Logger->get()
        );

        $this->assertTrue($this->Logger->added() === 0);
    }

    /**
     * Save logs with default states.
     *
     * @since 1.1.2
     */
    public function testSaveLogsWithDefaultStates()
    {
        new Logger();

        $log = $this->Logger->save('SUCCESS', 100, 'msg', __LINE__, __FILE__);
        $log &= $this->Logger->save('JOIN', 200, 'msg', __LINE__, __FILE__);
        $log &= $this->Logger->save('INFO', 300, 'msg', __LINE__, __FILE__);
        $log &= $this->Logger->save('WARNING', 400, 'msg', __LINE__, __FILE__);
        $log &= $this->Logger->save('ERROR', 500, 'msg', __LINE__, __FILE__);
        $log &= $this->Logger->save('FATAL', 600, 'msg', __LINE__, __FILE__);
        $log &= $this->Logger->save('REQUEST', 700, 'msg', __LINE__, __FILE__);
        $log &= $this->Logger->save('RESPONSE', 800, 'msg', __LINE__, __FILE__);

        $this->assertInternalType('array', $logs = $this->Logger->get());

        $this->assertTrue($logs[0]['type'] === 'success');
        $this->assertTrue($logs[1]['type'] === 'join');
        $this->assertTrue($logs[7]['type'] === 'response');

        $this->assertTrue($log === 1);

        $this->assertTrue($this->Logger->added() === 8);
    }

    /**
     * Save logs with custom states.
     *
     * @since 1.1.2
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

        new Logger($this->ROOT . '/log/', 'logs', 500, '58.80.84.44', $states);

        $log = $this->Logger->save('CUSTOM-1', 100, 'msg', __LINE__, __FILE__);
        $log &= $this->Logger->save('CUSTOM-2', 200, 'msg', __LINE__, __FILE__);
        $log &= $this->Logger->save('CUSTOM-4', 400, 'msg', __LINE__, __FILE__);

        $this->assertTrue($log === 1);

        $this->assertFalse(
            $this->Logger->save('CUSTOM-3', 300, 'msg', __LINE__, __FILE__)
        );

        $this->assertTrue($this->Logger->added() === 3);

        $this->assertInternalType('array', $logs = $this->Logger->get());

        $this->assertTrue($logs[0]['type'] === 'custom-1');
        $this->assertTrue($logs[1]['type'] === 'custom-2');
        $this->assertTrue($logs[2]['type'] === 'custom-4');
    }

    /**
     * Save logs with custom parameters.
     *
     * @since 1.1.2
     */
    public function testSaveLogsWithCustomParams()
    {
        new Logger();

        $params = [
            'id-user' => 68,
            'name-user' => 'Joe',
            'city' => 'Seville',
        ];

        $this->Logger->save('SUCCESS', 100, 'msg', __LINE__, __FILE__, $params);

        $this->assertInternalType('array', $logs = $this->Logger->get());

        $this->assertTrue($logs[0]['type'] === 'success');
        $this->assertTrue($logs[0]['id-user'] === 68);
        $this->assertTrue($logs[0]['name-user'] === 'Joe');
        $this->assertTrue($logs[0]['city'] === 'Seville');

        $this->assertTrue($this->Logger->added() === 1);
    }

    /**
     * Save logs with custom states and without global state [FALSE].
     *
     * @since 1.1.2
     */
    public function testSaveLogsWithCustomStatesAndWithoutGlobal()
    {
        new Logger($this->ROOT . '/log/', 'logs', 500, '58.80.84.44', []);

        $this->assertFalse(
            $this->Logger->save('CUSTOM-1', 300, 'msg', __LINE__, __FILE__)
        );

        $this->assertTrue($this->Logger->added() === 0);
    }

    /**
     * Store logs.
     *
     * @since 1.1.2
     */
    public function testStoreLogs()
    {
        new Logger();

        $this->Logger->save('SUCCESS', 100, 'msg', __LINE__, __FILE__);
        $this->Logger->save('JOIN', 200, 'msg', __LINE__, __FILE__);
        $this->Logger->save('INFO', 300, 'msg', __LINE__, __FILE__);
        $this->Logger->save('WARNING', 400, 'msg', __LINE__, __FILE__);
        $this->Logger->save('ERROR', 500, 'msg', __LINE__, __FILE__);
        $this->Logger->save('FATAL', 600, 'msg', __LINE__, __FILE__);
        $this->Logger->save('REQUEST', 700, 'msg', __LINE__, __FILE__);
        $this->Logger->save('RESPONSE', 800, 'msg', __LINE__, __FILE__);

        $this->assertInternalType('array', $logs = $this->Logger->get());

        $this->assertTrue($logs[0]['type'] === 'success');
        $this->assertTrue($logs[1]['type'] === 'join');
        $this->assertTrue($logs[7]['type'] === 'response');

        $this->assertTrue($this->Logger->added() === 8);

        $this->assertTrue($this->Logger->store());

        $this->assertFileExists($this->ROOT . '/log/logs.jsond');
    }

    /**
     * Store logs when no logs have been saved.
     *
     * @since 1.1.2
     */
    public function testStoreNotSavedLogs()
    {
        new Logger();

        $this->assertTrue($this->Logger->added() === 0);

        $this->assertFalse($this->Logger->store());
    }

    /**
     * Define directory for scripts and get url from file.
     *
     * @since 1.1.2
     */
    public function testLoadScript()
    {
        $this->assertContains(
            $this->JS . 'logger.min-',
            $script = $this->Logger->script($this->JS)
        );

        $this->assertFileExists($this->ROOT . '/js/' . basename($script));
    }

    /**
     * Define directory for styles and get url from file.
     *
     * @since 1.1.2
     */
    public function testLoadStyles()
    {
        $this->assertContains(
            $this->CSS . 'logger.min-',
            $style = $this->Logger->style($this->CSS)
        );

        $this->assertFileExists($this->ROOT . '/css/' . basename($style));
    }

    /**
     * Store logs when no logs have been saved.
     *
     * @since 1.1.2
     */
    public function testRenderLogs()
    {
        new Logger();

        $this->Logger->save('SUCCESS', 100, 'msg', __LINE__, __FILE__);
        $this->Logger->save('JOIN', 200, 'msg', __LINE__, __FILE__);
        $this->Logger->save('INFO', 300, 'msg', __LINE__, __FILE__);

        printf('<link href="%s">', $this->Logger->style($this->CSS));

        printf('<script src="%s">', $this->Logger->script($this->JS));

        $this->assertTrue($this->Logger->render());

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
