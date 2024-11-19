<?php

namespace common\components\logger\handlers;

class DbLogger extends BaseLogger
{
    private $connection;

    public function __construct(string $type, string $connection)
    {
        $this->connection = $connection;
        parent::__construct($type);
    }

    public function send(string $message): void
    {
        echo "Message {$message} saved in database, type {$this->getType()}, ({$this->connection}).\n";
    }
}
