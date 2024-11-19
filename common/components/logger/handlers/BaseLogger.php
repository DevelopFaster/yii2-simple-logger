<?php

namespace common\components\logger\handlers;

use yii\base\BaseObject;
use common\components\logger\interfaces\LoggerSendInterface;

abstract class BaseLogger extends BaseObject implements LoggerSendInterface
{
    private $type;

    public function __construct(string $type) {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
