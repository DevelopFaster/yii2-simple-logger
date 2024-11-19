<?php

namespace common\components\logger;

use yii\base\Component;
use common\components\logger\interfaces\LoggerInterface;
use common\components\logger\interfaces\LoggerSendInterface;

class Logger extends Component implements LoggerInterface
{
    /**
     * @var LoggerSendInterface[]
     */
    private array $loggerTypes;
    
    private LoggerSendInterface $currentLoggerHandler;

    public function __construct(array $loggerTypes, $config = [])
    {   
        foreach ($loggerTypes as $logger) {
            $this->registerLogger($logger);
            $this->setType($logger->getType());
        }

        if (isset($config['defaultType'])) {
            $this->setType($config['defaultType']);
            unset($config['defaultType']);
        }

        parent::__construct($config);
    }

    private function registerLogger(LoggerSendInterface $logger): void
    {
        $this->loggerTypes[$logger->getType()] = $logger;
    }

   /**
     * {@inheritdoc}
     */
    public function send(string $message): void
    {
        $this->currentLoggerHandler->send($message);
    }

    public function sendToAll(string $message) 
    {
		foreach ($this->loggerTypes as $handler) {
			$handler->send($message);
		}
    }
    
    /**
     * {@inheritdoc}
     */
    function sendByLogger(string $message, string $type): void
    {
        $this->checkType($type);
        $this->loggerTypes[$type]->send($message);
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return $this->currentLoggerHandler->getType();
    }

    /**
     * {@inheritdoc}
     */
    public function setType(string $type): void
    {   
        $this->checkType($type);
        $this->currentLoggerHandler = $this->loggerTypes[$type];
    }

    private function checkType(string $type)
    {
        if (!isset($this->loggerTypes[$type])) {
            throw new \InvalidArgumentException("Logger with type {$type} is not configured.");
        }
    }
}
