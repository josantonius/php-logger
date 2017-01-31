<?php
/**
 * Php library to create logs easily and store them in Json format.
 * 
 * @category   JST
 * @package    Logger
 * @subpackage LoggerException
 * @author     Josantonius - info@josantonius.com
 * @copyright  Copyright (c) 2017 JST PHP Framework
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @version    1.0.0
 * @link       https://github.com/Josantonius/PHP-Logger
 * @since      File available since 1.0.0 - Update: 2017-01-21
 */

namespace Josantonius\Logger\Exception;

/**
 * Exception class for Logger library.
 *
 * You can use an exception and error handler with this library.
 *
 * @since 1.0.0
 *
 * @link https://github.com/Josantonius/PHP-ErrorHandler
 */
class LoggerException extends \Exception { 

    /**
     * Exception handler.
     *
     * @since 1.0.0
     *
     * @param string $msg    → message error (Optional)
     * @param int    $error  → error code (Optional)
     * @param int    $status → HTTP response status code (Optional)
     */
    public function __construct($msg = '', $error = 0, $status = 0) {

        $this->message    = $msg;
        $this->code       = $error;
        $this->statusCode = $status;
    }
}