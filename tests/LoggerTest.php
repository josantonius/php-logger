<?php 
/**
 * Php library to create logs easily and store them in Json format.
 * 
 * @category   JST
 * @package    Logger
 * @subpackage LoggerTest
 * @author     Josantonius - info@josantonius.com
 * @copyright  Copyright (c) 2017 JST PHP Framework
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @version    1.1.0
 * @link       https://github.com/Josantonius/PHP-Logger
 * @since      File available since 1.0.0 - Update: 2017-01-30
 */

namespace Josantonius\Logger\Tests;

use Josantonius\Logger\Logger;

/**
 * Tests class for Logger library.
 *
 * @since 1.0.0
 */
class LoggerTest { 
                                                                                     
    /**
     * Save logs. 
     *
     * If you don't specify it, Logs are saved in /log folder in root directory.
     *
     * @uses new Logger($path, $filename, $maximumLogsToSave, $userIP, $states); 
     * @uses Logger::save($state, $code, $HTTPStatusCode, $message, $line, $file);
     *
     * @since 1.0.0
     */
    public function testSaveLog() {

        new Logger();

        Logger::save('JOIN',    800, 100, 'Your message here', __LINE__, __FILE__);
        Logger::save('INFO',    801, 200, 'Your message here', __LINE__, __FILE__);
        Logger::save('WARNING', 802, 300, 'Your message here', __LINE__, __FILE__);
        Logger::save('ERROR',   803, 400, 'Your message here', __LINE__, __FILE__);
        Logger::save('FATAL',   804, 500, 'Your message here', __LINE__, __FILE__);

        Logger::storeLogs();
    }

    /**
     * Save logs indicating a specific route where to store them and filename.
     *
     * @uses new Logger($path, $filename, $maximumLogsToSave, $userIP, $states); 
     * @uses Logger::save($state, $code, $HTTPStatusCode, $message, $line, $file);
     *
     * @since 1.0.0
     */
    public function testSaveLogWithFilepath() {

        $filename = 'logs';

        $path     = $_SERVER['DOCUMENT_ROOT'] . '/my-app/log/';

        new Logger($path, $filename);

        Logger::save('JOIN',    800, 100, 'Your message here', __LINE__, __FILE__);
        Logger::save('INFO',    801, 200, 'Your message here', __LINE__, __FILE__);
        Logger::save('WARNING', 802, 300, 'Your message here', __LINE__, __FILE__);
        Logger::save('ERROR',   803, 400, 'Your message here', __LINE__, __FILE__);
        Logger::save('FATAL',   804, 500, 'Your message here', __LINE__, __FILE__);

        Logger::storeLogs();
    }

    /**
     * Save logs with filepath, filename and maximum logs to save.
     *
     * @uses new Logger($path, $filename, $maximumLogsToSave, $userIP, $states); 
     * @uses Logger::save($state, $code, $HTTPStatusCode, $message, $line, $file);
     *
     * @since 1.0.0
     */
    public function testSaveLogWithLimitLogsNumber() {

        $logNumber = 300;

        $filename = 'logs';

        $path = $_SERVER['DOCUMENT_ROOT'] . '/my-app/log/';

        new Logger($path, $filename, $logNumber);

        Logger::save('JOIN',    800, 100, 'Your message here', __LINE__, __FILE__);
        Logger::save('INFO',    801, 200, 'Your message here', __LINE__, __FILE__);
        Logger::save('WARNING', 802, 300, 'Your message here', __LINE__, __FILE__);
        Logger::save('ERROR',   803, 400, 'Your message here', __LINE__, __FILE__);
        Logger::save('FATAL',   804, 500, 'Your message here', __LINE__, __FILE__);

        Logger::storeLogs();
    }

    /**
     * Save logs with filepath, filename, maximum logs to save and user IP.
     *
     * @uses new Logger($path, $filename, $maximumLogsToSave, $userIP, $states); 
     * @uses Logger::save($state, $code, $HTTPStatusCode, $message, $line, $file);
     *
     * @since 1.0.0
     */
    public function testSaveLogWithUserIP() {

        $logNumber = 300;

        $filename = 'logs';

        $ip = $_SERVER['REMOTE_ADDR'];

        $path = $_SERVER['DOCUMENT_ROOT'] . '/my-app/log/';

        new Logger($path, $filename, $logNumber, $ip);

        Logger::save('JOIN',    800, 100, 'Your message here', __LINE__, __FILE__);
        Logger::save('INFO',    801, 200, 'Your message here', __LINE__, __FILE__);
        Logger::save('WARNING', 802, 300, 'Your message here', __LINE__, __FILE__);
        Logger::save('ERROR',   803, 400, 'Your message here', __LINE__, __FILE__);
        Logger::save('FATAL',   804, 500, 'Your message here', __LINE__, __FILE__);

        Logger::storeLogs();
    }

    /**
     * Save logs with filepath, filename, maximum logs to save, IP and custom states.
     *
     * @uses new Logger($path, $filename, $maximumLogsToSave, $userIP, $states); 
     * @uses Logger::save($state, $code, $HTTPStatusCode, $message, $line, $file);
     *
     * @since 1.0.0
     */
    public function testSaveLogWithUserCustomStates() {

        $logNumber = 300;

        $filename = 'logs';

        $ip = $_SERVER['REMOTE_ADDR'];

        $path = $_SERVER['DOCUMENT_ROOT'] . '/my-app/log/';

        $customStates  = [ 
            'is_active' => 1, # Mandatory, don´t change
            'response'  => 1,
            'request'   => 1,
            'notice'    => 1
        ];  

        new Logger($path, $filename, $logNumber, $ip, $customStates);

        Logger::save('RESPONSE', 800, 100, 'Your message here', __LINE__, __FILE__);
        Logger::save('REQUEST',  801, 200, 'Your message here', __LINE__, __FILE__);
        Logger::save('NOTICE',   802, 300, 'Your message here', __LINE__, __FILE__);

        Logger::storeLogs();
    }

    /**
     * Save logs with filepath, filename, maximum logs,IP, custom states and params.
     *
     * @uses new Logger($path, $filename, $maximumLogsToSave, $userIP, $states); 
     * @uses Logger::save($state, $code, $HTTP, $msg, $line, $file, $customParams);
     *
     * @since 1.0.0
     */
    public function testSaveLogWithUserCustomParams() {

        $logNumber = 300;

        $filename = 'logs';

        $ip = $_SERVER['REMOTE_ADDR'];

        $path = $_SERVER['DOCUMENT_ROOT'] . '/my-app/log/';

        $customStates  = [ 
            'is_active' => 1, # Mandatory, don´t change
            'response'  => 1,
            'request'   => 1,
            'notice'    => 1
        ];  

        $customParams  = [ 
            'id_user'   => 68,
            'name_user' => 'Joe',
            'city'      => 'Seville'
        ]; 

        new Logger($path, $filename, $logNumber, $ip, $customStates);

        Logger::save('NOTICE', 80, 100, 'message', __LINE__, __FILE__, $customParams);

        Logger::storeLogs();
    }

    /**
     * Disable saving logs.
     *
     * @uses new Logger($path, $filename, $maximumLogsToSave, $userIP, $states); 
     * @uses Logger::save($state, $code, $HTTP, $msg, $line, $file, $customParams);
     *
     * @since 1.0.0
     */
    public function testDisableLogs() {

        $logNumber = 300;

        $filename = 'logs';

        $ip = $_SERVER['REMOTE_ADDR'];

        $path = $_SERVER['DOCUMENT_ROOT'] . '/my-app/log/';

        $customStates  = [ 
            'is_active' => 0, # Set to 0
            'response'  => 1,
            'request'   => 1,
            'notice'    => 1
        ];  

        $customParams  = [ 
            'id_user'   => 68,
            'name_user' => 'Joe',
            'city'      => 'Seville'
        ]; 

        new Logger($path, $filename, $logNumber, $ip, $customStates);

        Logger::save('NOTICE', 80, 100, 'message', __LINE__, __FILE__, $customParams);

        Logger::storeLogs();
    }

    /**
     * Disable saving logs by state.
     *
     * @uses new Logger($path, $filename, $maximumLogsToSave, $userIP, $states); 
     * @uses Logger::save($state, $code, $HTTP, $msg, $line, $file, $customParams);
     *
     * @since 1.0.0
     */
    public function testDisableLogsByState() {

        $logNumber = 300;

        $filename = 'logs';

        $ip = $_SERVER['REMOTE_ADDR'];

        $path = $_SERVER['DOCUMENT_ROOT'] . '/my-app/log/';

        $customStates  = [ 
            'is_active' => 1,
            'response'  => 0, # Set to 0
            'request'   => 0, # Set to 0
            'notice'    => 1
        ];  

        $customParams  = [ 
            'id_user'   => 68,
            'name_user' => 'Joe',
            'city'      => 'Seville'
        ]; 

        new Logger($path, $filename, $logNumber, $ip, $customStates);

        Logger::save('RESPONSE', 800, 100, 'Your message here', __LINE__, __FILE__);
        Logger::save('REQUEST',  801, 200, 'Your message here', __LINE__, __FILE__);
        Logger::save('NOTICE',   802, 300, 'Your message here', __LINE__, __FILE__);

        Logger::storeLogs();
    }

    /**
     * Get log list.
     *
     * @since 1.0.0
     */
    public function testGetLogs() {

        new Logger();

        echo '<pre>'; var_dump(Logger::$logs); echo '</pre>';

        Logger::storeLogs();
    }

    /**
     * Get log list from custom path.
     *
     * @since 1.0.0
     */
    public function testGetLogsFromCustomPath() {

        $filename = 'logs';

        $path = $_SERVER['DOCUMENT_ROOT'] . '/my-app/log/';

        new Logger($path, $filename);

        echo '<pre>'; var_dump(Logger::$logs); echo '</pre>';

        Logger::storeLogs();
    }

    /**
     * Could not create or open file exception.
     *
     * @uses new Logger($path, $filename, $maximumLogsToSave, $userIP, $states); 
     * @uses Logger::save($state, $code, $HTTPStatusCode, $message, $line, $file);
     *
     * @since 1.0.0
     */
    public function testExceptionCouldCreatePath() {

        $filename = 'logs';

        $path = '../../../';

        new Logger($path, $filename);

        Logger::save('JOIN',    800, 100, 'Your message here', __LINE__, __FILE__);

        Logger::storeLogs();
    }
}