<?php

namespace common\components\logger\handlers;

class FileLogger extends BaseLogger
{
    public function send(string $message): void
    {
        echo "Message {$message} saved in file.\n";
    }
}
