<?php 

namespace console\controllers;

use common\components\logger\handlers\DbLogger;
use Yii;
use yii\console\Controller;
use yii\debug\models\search\Db;

class LogController extends Controller
{
    public function actionLog(string $message)
    {
        Yii::$app->logger->send($message);
    }

    public function actionLogTo(string $message, string $type)
    {
        Yii::$app->logger->sendByLogger($message, $type);
    }

    public function actionLogToAll(string $message)
    {
       Yii::$app->logger->sendToAll($message);
    }
}
