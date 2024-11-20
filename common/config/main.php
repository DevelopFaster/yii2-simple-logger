<?php

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'logger' => [
            'class' => common\components\logger\interfaces\LoggerInterface::class
        ],
        'loggerHandlersFactory' => [
            'class' => common\components\logger\LoggerHandlersFactory::class,
            '__construct()' => [
                [
                    common\components\logger\LoggerTypesEnum::DB1 => [
                        'class' => common\components\logger\handlers\DbLogger::class,
                        '__construct()' => [
                            common\components\logger\LoggerTypesEnum::DB1,
                            '127.0.0.1'
                        ]
                    ],
                    common\components\logger\LoggerTypesEnum::DB2 => [
                        'class' => common\components\logger\handlers\DbLogger::class,
                        '__construct()' => [
                            common\components\logger\LoggerTypesEnum::DB2,
                            '127.0.0.2'
                        ]
                    ],
                    common\components\logger\LoggerTypesEnum::EMAIL => common\components\logger\handlers\EmailLogger::class,
                    common\components\logger\LoggerTypesEnum::FILE => common\components\logger\handlers\FileLogger::class,
                ]
            ]
        ],
    ],
    'container' => [
        'definitions' => [
            common\components\logger\interfaces\LoggerInterface::class => function($container, $params, $config) {
                return new common\components\logger\Logger(
                    [
                        Yii::$app->loggerHandlersFactory->createLogger(common\components\logger\LoggerTypesEnum::FILE),
                        Yii::$app->loggerHandlersFactory->createLogger(common\components\logger\LoggerTypesEnum::DB1),
                        Yii::$app->loggerHandlersFactory->createLogger(common\components\logger\LoggerTypesEnum::DB2),
                        Yii::$app->loggerHandlersFactory->createLogger(common\components\logger\LoggerTypesEnum::EMAIL),
                    ],
                    [
                        'defaultType' => common\components\logger\LoggerTypesEnum::FILE
                    ]
                );
            },
        ]
    ],
];
