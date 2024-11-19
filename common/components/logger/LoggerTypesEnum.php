<?php 

namespace common\components\logger;

enum LoggerTypesEnum: string {
    CONST DB1 = 'db1';
    CONST DB2 = 'db2';
    CONST EMAIL = 'email';
    CONST FILE = 'file';
}