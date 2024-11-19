<?php

namespace common\components\logger\interfaces;

interface LoggerInterface
{    
    /**
     * send
     *
     * @param  string $message
     * @return void
     */
    public function send(string $message): void;    
    
    /**
     * sendByLogger
     *
     * @param  string $message
     * @param  string $type
     * @return void
     */
    public function sendByLogger(string $message, string $type): void;    
    
    /**
     * getType
     *
     * @return string
     */
    public function getType(): string;    
    
    /**
     * setType
     *
     * @param  string $type
     * @return void
     */
    public function setType(string $type): void;
}
