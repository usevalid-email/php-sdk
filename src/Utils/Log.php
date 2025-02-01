<?php

namespace UseValidEmail\Sdk\Utils;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class Log implements LoggerInterface
{
    private bool $saveLog = false;

    public function __construct(bool $saveLog = false)
    {
        $this->saveLog = $saveLog;
    }

    public static function make(bool $saveLog = false): Log
    {
        return new Log($saveLog);
    }

    public function emergency($message, array $context = []): void
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    public function alert($message, array $context = []): void
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    public function critical($message, array $context = []): void
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    public function error($message, array $context = []): void
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    public function warning($message, array $context = []): void
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    public function notice($message, array $context = []): void
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    public function info($message, array $context = []): void
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    public function debug($message, array $context = []): void
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    public function log($level, $message, array $context = []): void
    {
        if ($this->saveLog) {
            $this->saveLog($level, $message, $context);
        }
        $this->logToConsole($level, $message, $context);
    }

    private function saveLog($level, $message, $context = []): void
    {
        $log = [
            'level' => $level,
            'message' => $message,
            'context' => $context,
        ];

        $file_name = 'log_'.date('Y-m-d').'.log';
        $file_base_path = 'logs/';

        if (! file_exists($file_base_path)) {
            mkdir($file_base_path, 0777, true);
        }
        file_put_contents($file_base_path.$file_name, json_encode($log).PHP_EOL, FILE_APPEND);
    }

    private function logToConsole($level, $message, $context = []): void
    {
        $message = "[{$level}] ".date('Y-m-d H:i:s').' '.$message."\n\n".json_encode($context);
        $message .= PHP_EOL;
        error_log($message, 0, 'php://stdout');
    }
}
