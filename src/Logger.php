<?php
/**
 * PHP library to create logs easily and store them in Json format.
 *
 * @author    Josantonius <hello@josantonius.com>
 * @copyright 2017 - 2018 (c) Josantonius - PHP-Logger
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/Josantonius/PHP-Logger
 * @since     1.0.0
 */
namespace Josantonius\Logger;

use Josantonius\Json\Json;

/**
 * Logger handler.
 */
class Logger
{
    /**
     * Path to save logs.
     *
     * @var string
     */
    protected static $path;

    /**
     * File to save logs.
     *
     * @var string
     */
    protected static $filepath;

    /**
     * Current file name that is saved in the log.
     *
     * @var string
     */
    protected static $filename;

    /**
     * Contents of the current log.
     *
     * @var array
     */
    protected static $log;

    /**
     * Array with logs.
     *
     * @var array
     */
    protected static $logs = null;

    /**
     * Maximum number of saved logs.
     *
     * @var int
     */
    protected static $logNumber;

    /**
     * Counter logs.
     *
     * @var int
     */
    protected static $counterLogs = 0;

    /**
     * Different states for logs.
     *
     * @var string
     */
    protected static $states;

    /**
     * Initiator for site debug management.
     *
     * @param string $path      → path name to save file with logs
     * @param string $filename  → json file name that will save the logs
     * @param int    $logNumber → maximum number of logs to save to file
     * @param string $ip        → if you want to get to another library
     * @param array  $states    → different states for logs
     */
    public function __construct($path = null, $filename = null, $logNumber = 200, $ip = null, $states = null)
    {
        self::$logNumber = $logNumber;
        $this->setServerInfo($ip);
        $this->setStates($states);
        $this->setFilePath($path, $filename);

        register_shutdown_function([$this, 'shutdown']);

        if (isset(self::$states['global']) && self::$states['global']) {
            self::get();
        }
    }

    /**
     * Save log line.
     *
     * @param string $type    → error type or warning
     * @param int    $code    → HTTP response status code
     * @param string $message → message
     * @param int    $line    → line from which the save is executed
     * @param string $file    → filepath from which the method is called
     * @param array  $data    → extra custom parameters
     *
     * @return bool
     */
    public static function save($type, $code, $msg, $line, $file, $data = 0)
    {
        $type = strtolower($type);

        $status = (isset(self::$states[$type])) ? self::$states[$type] : 0;

        if (! $status || ! self::$states['global']) {
            return false;
        }

        self::setLogInfo($type, $code, $msg, $line, $file);

        foreach ((is_array($data)) ? $data : [] as $key => $value) {
            self::$log[$key] = $value;
        }

        $count = count(self::$logs);

        self::$logs[$count++] = self::$log;

        self::$counterLogs++;

        return true;
    }

    /**
     * Save logs to Json file.
     *
     * @uses \Json::arrayToFile() → create JSON file from array
     *
     * @return bool
     */
    public static function store()
    {
        if (self::$counterLogs !== 0) {
            self::validateLogsNumber();
            Json::arrayToFile(self::$logs, self::$filepath);
            self::$counterLogs = 0;

            return true;
        }

        return false;
    }

    /**
     * Get saved logs.
     *
     * @since 1.1.2
     *
     * @uses \Json::fileToArray() → array from JSON file content
     *
     * @return array → logs saved
     */
    public static function get()
    {
        if (is_null(self::$logs)) {
            self::$logs = Json::fileToArray(self::$filepath);
        }

        return self::$logs;
    }

    /**
     * Define directory for scripts and get url from file.
     *
     * @since 1.1.2
     *
     * @param string $url → path url where JS file will be created & loaded
     *
     * @return string → file url
     */
    public static function script($url)
    {
        return self::setFile('logger.min', 'script', $url);
    }

    /**
     * Define directory for styles and get url from file.
     *
     * @since 1.1.2
     *
     * @param string $url → path url where CSS file will be created & loaded
     *
     * @return string → file url
     */
    public static function style($url)
    {
        return self::setFile('logger.min', 'style', $url);
    }

    /**
     * Get number of logs added in the current section.
     *
     * @since 1.1.2
     *
     * @return int → logs added in the current section
     */
    public static function added()
    {
        return self::$counterLogs;
    }

    /**
     * Display logger section.
     *
     * @since 1.1.2
     *
     * @return bool true
     */
    public static function render()
    {
        $path = dirname(__DIR__);

        require_once $path . '/src/public/template/logger.php';

        return true;
    }

    /**
     * Reset parameters.
     *
     * @since 1.1.2
     *
     * @return bool true
     */
    public static function reset()
    {
        self::$path = null;
        self::$filepath = null;
        self::$filename = null;
        self::$logs = null;
        self::$logNumber = null;
        self::$states = null;
        self::$counterLogs = 0;

        return true;
    }

    /**
     * Method that will be called in case of to register shutdown.
     */
    public function shutdown()
    {
        if (isset(self::$states['global'])) {
            $state = self::$states['global'];
        }

        if (isset($state) && count(self::$counterLogs) > 0) {
            self::store();
        }
    }

    /**
     * Get library version.
     *
     * @since 1.1.2
     *
     * @return string
     */
    protected static function getLibraryVersion()
    {
        $path = rtrim(dirname(__DIR__), '/') . '/';
        $composer = Json::fileToArray($path . 'composer.json');

        return isset($composer['version']) ? $composer['version'] : '1.1.2';
    }

    /**
     * Creating files (css/js/php) in custom locations.
     *
     * @since 1.1.2
     *
     * @param string $filename → file name
     * @param string $type     → script|style
     * @param string $pathUrl  → path url where file will be created
     *
     * @return string → file url
     */
    private static function setFile($filename, $type, $pathUrl)
    {
        $ext = ($type == 'script') ? 'js' : 'css';

        $root = $_SERVER['DOCUMENT_ROOT'];

        $version = str_replace('.', '-', self::getLibraryVersion());

        $path = rtrim($root . parse_url($pathUrl)['path'], '/') . '/';

        if (! file_exists($toPath = $path . "$filename-$version.$ext")) {
            if (! is_dir($path)) {
                mkdir($path, 0777, true);
            }

            $path = rtrim(dirname(__DIR__), '/') . '/';
            $from = $path . 'src/public/' . $ext . "/$filename.$ext";
            $file = file_get_contents($from);

            file_put_contents($toPath, $file);
        }

        return rtrim($pathUrl, '/') . '/' . "$filename-$version.$ext";
    }

    /**
     * Set server information.
     *
     * @since 1.1.2
     *
     * @param string $ip → user ip
     */
    private function setServerInfo($ip)
    {
        if (! isset($_SERVER['HTTP_REFERER'])) {
            $_SERVER['HTTP_REFERER'] = '';
        }

        $validate = filter_var($ip, FILTER_VALIDATE_IP);

        self::$log['user-ip'] = ($validate) ? $ip : $_SERVER['REMOTE_ADDR'];

        self::$log['uri'] = $_SERVER['REQUEST_URI'];
        self::$log['referer'] = $_SERVER['HTTP_REFERER'];
        self::$log['port'] = $_SERVER['REMOTE_PORT'];
        self::$log['server-ip'] = $_SERVER['SERVER_ADDR'];
        self::$log['user-agent'] = $_SERVER['HTTP_USER_AGENT'];
    }

    /**
     * Set logs information.
     *
     * @since 1.1.2
     *
     * @param string $type    → error type or warning
     * @param string $code    → HTTP response status code
     * @param string $message → message
     * @param int    $line    → maximum number of logs to save to file
     * @param string $file    → filepath from which the method is called
     */
    private static function setLogInfo($type, $code, $msg, $line, $file)
    {
        self::$log['type'] = $type;
        self::$log['code'] = $code;
        self::$log['message'] = $msg;
        self::$log['line'] = $line;
        self::$log['file'] = $file;
        self::$log['hour'] = date('H:i:s');
        self::$log['date'] = date('Y-m-d');
    }

    /**
     * Set logs file path.
     *
     * @since 1.1.2
     *
     * @param string $path     → path name to save file with logs
     * @param string $filename → json file name that will save the logs
     */
    private function setFilePath($path, $filename)
    {
        $defaultPath = $_SERVER['DOCUMENT_ROOT'] . '/log/';

        self::$path = (! is_null($path)) ? $path : $defaultPath;

        self::$filename = $filename ? $filename . '.jsond' : 'logs.jsond';

        self::$filepath = self::$path . self::$filename;
    }

    /**
     * Set logs states.
     *
     * @since 1.1.2
     *
     * @param array $states → states for logs
     */
    private function setStates($states)
    {
        $defaultStates = [
            'global' => true,
            'success' => true,
            'join' => true,
            'info' => true,
            'warning' => true,
            'error' => true,
            'fatal' => true,
            'request' => true,
            'response' => true,
        ];

        self::$states = (! is_null($states)) ? $states : $defaultStates;
    }

    /**
     * Validate maximum logs number.
     */
    private static function validateLogsNumber()
    {
        $logsCounter = count(self::$logs);

        if (self::$logNumber < $logsCounter) {
            $logs = array_reverse(self::$logs);
            $conserve = self::$logNumber / 2;

            for ($i = 0; $i < $conserve; $i++) {
                $conserveLogs[$i] = $logs[$i];
            }

            self::$logs = array_reverse($conserveLogs);
        }
    }
}
