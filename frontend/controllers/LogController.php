<?php 

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

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
