<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template With Simple Logger Component</h1>
</p>

DIRECTORY STRUCTURE
-------------------

```
common/components
└── common/components/logger
    ├── handlers
    │   ├── BaseLogger.php
    │   ├── DbLogger.php
    │   ├── EmailLogger.php
    │   └── FileLogger.php
    ├── interfaces
    │   ├── LoggerInterface.php
    │   └── LoggerSendInterface.php
    ├── LoggerHandlersFactory.php
    ├── LoggerTypesEnum.php
    └── Logger.php
frontend/controllers/LogController.php
console/controllers/LogController.php
common/config/main.php
```
CONFIG
-------------------
common/config/main.php

```
return [
    ...
    'components' => [
       ...
        'logger' => [
            'class' => common\components\logger\Logger::class
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
            common\components\logger\Logger::class => function($container, $params, $config) {
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
```
actions for console appliaction

```
    log/log test
    log/log-to test db
    log/log-to-all test
```

actions for web appliaction

```
    http://localhost:20080/log/log/?message=test&type=db
    http://localhost:20080/log/log-to/?message=test&type=db1
    http://localhost:20080/log/log-to-all/?message=test
```

#### The web version is experiencing a header submission error, which is implemented to demonstrate that the component works across multiple applications.

ENVIRONMENT
-------------------
```
docker-compose.yml
```
