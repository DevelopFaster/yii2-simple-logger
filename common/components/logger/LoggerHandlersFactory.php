<?php


namespace common\components\logger;

use Yii;
use common\components\logger\interfaces\LoggerSendInterface;

class LoggerHandlersFactory
{    
    private $loggerTypes;

    public function __construct($loggerTypes)
    {
        $this->loggerTypes = $loggerTypes;
    }

    public function createLogger(string $type): LoggerSendInterface
    {
        if (!isset($this->loggerTypes[$type])) {
            throw new \InvalidArgumentException("Logger with type {$type} is not configured.");
        }

        return Yii::createObject($this->loggerTypes[$type], [$type]);
    }
}
