<?php 

namespace common\components\logger\interfaces;

interface LoggerSendInterface
{        
    /**
     * send
     *
     * @param  mixed $message
     * @return void
     */
    public function send(string $message): void;    
    
    /**
     * getType
     *
     * @return string
     */
    public function getType(): string;
}
