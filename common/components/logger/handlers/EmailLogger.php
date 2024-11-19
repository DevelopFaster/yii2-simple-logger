<?php

namespace common\components\logger\handlers;

class EmailLogger extends BaseLogger
{
    public function send(string $message): void
    {
        echo "Message {$message} send to email.\n";
    }
}
