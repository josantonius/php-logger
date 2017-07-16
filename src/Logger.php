<?php
/**
 * Php library to create logs easily and store them in Json format.
 * 
 * @author     Josantonius - hello@josantonius.com
 * @copyright  Copyright (c)
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link       https://github.com/Josantonius/PHP-Logger
 * @since      1.0.0
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
     * @param  string $path      → path name to save file with logs
     * @param  string $filename  → json file name that will save the logs
     * @param  int    $logNumber → maximum number of logs to save to file
     * @param  string $ip        → user ip. If you want to get to another library
     * @param  array  $states    → different states for logs
     *
     * @return bool
     */
    public function __construct($path = null, $filename = null, $logNumber = 200,
                                                    $ip = null, $states    = null) {

        $defaultPath = $_SERVER['DOCUMENT_ROOT'] . '/log/';

        self::$path      = (!is_null($path))     ? $path     : $defaultPath;
        self::$filename  = (!is_null($filename)) ? $filename : 'logs';
        self::$filename .= '.jsond';
        self::$filepath  = self::$path . self::$filename;
        self::$logNumber = $logNumber;

        self::$log['ip']          = (isset($ip)) ? $ip : $_SERVER['REMOTE_ADDR'];
        self::$log['uri']         = $_SERVER['REQUEST_URI'];
        self::$log['referer']     = $_SERVER['HTTP_REFERER'];
        self::$log['remote-port'] = $_SERVER['REMOTE_PORT'];
        self::$log['ip-server']   = $_SERVER['SERVER_ADDR'];
        self::$log['user-agent']  = $_SERVER['HTTP_USER_AGENT'];

        $defaultStates  = [ 
            'is_active' => 1,
            'join'      => 1,
            'info'      => 1,
            'warning'   => 1, 
            'error'     => 1,
            'fatal'     => 1,
        ];  

        self::$states = (isset($states)) ? $states : $defaultStates;

        register_shutdown_function(array($this, 'shutdown'));

        return (self::$states['is_active']) ? $this->_getLogs() : false;
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

        if (!is_dir(self::$path)) {

            if (!mkdir(self::$path, 0755, true)) { 

                $message = 'Could not create directory in: ' . self::$path;

                throw new LoggerException($message, 706);
            }
        }

        if (is_file(self::$filepath)) {

            $logs = file_get_contents(self::$filepath);
            
            self::$logs = json_decode($logs, true);

            if (!count(self::$logs)) {

                self::save('INFO', 1, 200, 'DEBUG [ON]', __LINE__, __FILE__);
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

        $status = (isset(self::$states[$type])) ? self::$states[$type] : false;

        if (!isset($status) || !$status || !self::$states['is_active']) {

            return false;
        } 

        self::$log['type']    = $type ; 
        self::$log['state']   = $state; 
        self::$log['code']    = $code; 
        self::$log['message'] = $message; 
        self::$log['line']    = $line;
        self::$log['file']    = $file;
        self::$log['hour']    = date('H:i:s'); 
        self::$log['date']    = date('Y-m-d');

        if (is_array($data)) {

            foreach ($data as $key => $value) {

                self::$log[$key] = $value;
            }
        }

        $numLogs = 1;

        $count = count(self::$logs);

        self::$logs[$count++] = self::$log;

        self::$counterLogs++;

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

        if (self::$counterLogs === 0) {

            return true;
        }

        self::_validateLogsNumber();

        $json = json_encode(self::$logs);

        $file = fopen(self::$filepath, 'w+'); 

        if (!$file) {

            $message = 'Could not create or open file in: ' . self::$filepath;

            throw new LoggerException($message, 707);
        } 

        if (!fwrite($file, $json)) {

            $message = 'Could not write to file: ' . self::$filepath;

            throw new LoggerException($message, 708);
        }

        self::$counterLogs = 0;

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

        $logsCounter = count(self::$logs);

        if (self::$logNumber < $logsCounter) {

            $logs = array_reverse(self::$logs);

            $conserve = self::$logNumber / 2;

            for ($i=0; $i < $conserve; $i++) {

                $conserveLogs[$i] = $logs[$i];
            }

            self::$logs = array_reverse($conserveLogs);
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

        if (count(self::$counterLogs) > 0) {

            if (isset(self::$states['is_active']) && self::$states['is_active']) {

                self::storeLogs();
            }
        }
    }
}
