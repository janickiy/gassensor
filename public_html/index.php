<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../yii-app/vendor/autoload.php');
require(__DIR__ . '/../yii-app/vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../yii-app/common/config/bootstrap.php');
require(__DIR__ . '/../yii-app/frontend/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../yii-app/common/config/main.php'),
    require(__DIR__ . '/../yii-app/common/config/main-local.php'),
    require(__DIR__ . '/../yii-app/frontend/config/main.php'),
    require(__DIR__ . '/../yii-app/frontend/config/main-local.php')
);

(new yii\web\Application($config))->run();
