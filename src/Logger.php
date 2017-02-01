<?php
/**
 * Php library to create logs easily and store them in Json format.
 * 
 * @category   JST
 * @package    Logger
 * @subpackage Logger
 * @author     Josantonius - info@josantonius.com
 * @copyright  Copyright (c) 2017 JST PHP Framework
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @version    1.1.0
 * @link       https://github.com/Josantonius/PHP-Logger
 * @since      File available since 1.0.0 - Update: 2017-01-30
 */

namespace Josantonius\Logger;

use Josantonius\Logger\Exception\LoggerException;

/**
 * Logger handler.
 *
 * @since 1.0.0
 */
class Logger { 

    /**
     * Path to save logs.
     *
     * @since 1.0.0
     *
     * @var string $path
     */
    public static $path;

    /**
     * File to save logs.
     *
     * @since 1.0.0
     *
     * @var string $filepath
     */
    public static $filepath;

    /**
     * Current file name that is saved in the log.
     *
     * @since 1.0.0
     *
     * @var string $filename
     */
    public static $filename;

    /**
     * Contents of the current log.
     *
     * @since 1.0.0
     *
     * @var array $log
     */
    public static $log;

    /**
     * Array with logs.
     *
     * @since 1.0.0
     *
     * @var array $logs
     */
    public static $logs = null;

    /**
     * Maximum number of saved logs.
     *
     * @since 1.0.0
     *
     * @var int $logNumber
     */
    public static $logNumber;

    /**
     * Counter logs.
     *
     * @since 1.0.0
     *
     * @var int $counterLogs
     */
    public static $counterLogs = 0;

    /**
     * Different states for logs.
     *
     * @since 1.0.0
     *
     * @var string $states
     */
    public static $states;
                                                                                    
    /**
     * Initiator for site debug management.
     *
     * @since 1.0.0
     *
     * @param  string $path         → path name to save file with logs
     * @param  string $filename     → json file name that will save the logs
     * @param  int    $logNumber    → maximum number of logs to save to file
     * @param  string $ip           → user ip. If you want to get to another library
     * @param  array  $states       → different states for logs
     *
     * @return bool
     */
    public function __construct($path = null, $filename = null, $logNumber = 200,
                                                    $ip = null, $states    = null) {

        $defaultPath = $_SERVER['DOCUMENT_ROOT'] . '/log/';

        static::$path      = (!is_null($path))     ? $path     : $defaultPath;
        static::$filename  = (!is_null($filename)) ? $filename : 'logs';
        static::$filename .= '.jsond';
        static::$filepath  = static::$path . static::$filename;
        static::$logNumber = $logNumber;

        static::$log['ip']          = (isset($ip)) ? $ip : $_SERVER['REMOTE_ADDR'];
        static::$log['uri']         = $_SERVER['REQUEST_URI'];
        static::$log['referer']     = $_SERVER['HTTP_REFERER'];
        static::$log['remote-port'] = $_SERVER['REMOTE_PORT'];
        static::$log['ip-server']   = $_SERVER['SERVER_ADDR'];
        static::$log['user-agent']  = $_SERVER['HTTP_USER_AGENT'];

        $defaultStates  = [ 
            'is_active' => 1,
            'join'      => 1,
            'info'      => 1,
            'warning'   => 1, 
            'error'     => 1,
            'fatal'     => 1,
        ];  

        static::$states = (isset($states)) ? $states : $defaultStates;

        register_shutdown_function(array($this, 'shutdown'));

        return (static::$states['is_active']) ? $this->_getLogs() : false;
    }
                                                                                     
    /**
     * Get saved logs.
     *
     * @since 1.0.0
     *
     * @throws LoggerException → could not create directory
     * @return bool
     */
    private function _getLogs() {

        if (!is_dir(static::$path)) {

            if (!mkdir(static::$path, 0755, true)) { 

                $message = 'Could not create directory in: ' . static::$path;

                throw new LoggerException($message, 706);
            }
        }

        if (is_file(static::$filepath)) {

            $logs = file_get_contents(static::$filepath);
            
            static::$logs = json_decode($logs, true);

            if (!count(static::$logs)) {

                static::save('INFO', 1, 200, 'DEBUG [ON]', __LINE__, __FILE__);
            }
        } 

        return true;
    }
                                                                                     
    /**
     * Save log line.
     *
     * @since 1.0.0
     *
     * @param  string $type    → error type or warning
     * @param  int    $state   → error code
     * @param  string $code    → HTTP response status code
     * @param  string $message → message
     * @param  int    $line    → maximum number of logs to save to file
     * @param  string $file    → filepath from which the method is called
     * @param  array  $data    → extra custom parameters
     *
     * @return bool
     */
    public static function save($type, $state, $code, $message, 
                                        $line, $file, $data = null) {

        $type = strtolower($type); 

        $status = (isset(static::$states[$type])) ? static::$states[$type] : false;

        if (!isset($status) || !$status || !static::$states['is_active']) {

            return false;
        } 

        static::$log['type']    = $type ; 
        static::$log['state']   = $state; 
        static::$log['code']    = $code; 
        static::$log['message'] = $message; 
        static::$log['line']    = $line;
        static::$log['file']    = $file;
        static::$log['hour']    = date('H:i:s'); 
        static::$log['date']    = date('Y-m-d');

        if (is_array($data)) {

            foreach ($data as $key => $value) {

                static::$log[$key] = $value;
            }
        }

        $numLogs = 1;

        $count = count(static::$logs);

        static::$logs[$count++] = static::$log;

        static::$counterLogs++;

        return true;
    }
                                                     
    /**
     * Save logs to Json file.
     *
     * @since 1.0.0
     *
     * @throws LoggerException → could not create or open file
     * @throws LoggerException → could not write to file
     * @return bool
     */
    public static function storeLogs() {

        if (static::$counterLogs === 0) {

            return true;
        }

        static::_validateLogsNumber();

        $json = json_encode(static::$logs);

        $file = fopen(static::$filepath, 'w+'); 

        if (!$file) {

            $message = 'Could not create or open file in: ' . static::$filepath;

            throw new LoggerException($message, 707);
        } 

        if (!fwrite($file, $json)) {

            $message = 'Could not write to file: ' . static::$filepath;

            throw new LoggerException($message, 708);
        }

        static::$counterLogs = 0;

        return true;
    }
                                                                                     
    /**
     * Validate logs number saved so that it does not exceed the specified maximum.
     *
     * @since 1.0.0
     *
     * @return bool
     */
    private static function _validateLogsNumber() {

        $logsCounter = count(static::$logs);

        if (static::$logNumber < $logsCounter) {

            $logs = array_reverse(static::$logs);

            $conserve = static::$logNumber / 2;

            for ($i=0; $i < $conserve; $i++) {

                $conserveLogs[$i] = $logs[$i];
            }

            static::$logs = array_reverse($conserveLogs);
        }

        return true;
    }

    /**
     * Method that will be called in case of to register shutdown.
     * 
     * @since 1.0.0
     *
     * @uses Logger::storeLogs() → save current logs
     */
    public function shutdown() {

        if (count(static::$counterLogs) > 0) {

            if (isset(static::$states['is_active']) && static::$states['is_active']) {

                static::storeLogs();
            }
        }
    }
}