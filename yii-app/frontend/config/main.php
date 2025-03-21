<?php

use common\helpers\MyBehavior;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'session' => [
            'name' => 'sessid',
        ],
        'urlManager' => [
            'rules' => [
                    'catalog/manufacture/<slug>' => 'catalog/manufacture',
                    'news/<slug>' => 'news/slug',
                    'manufacture/<slug>' => 'manufacture/slug',
                    'applications/index' => 'applications/index',
                    'applications/<slug>' => 'applications/slug',
                    'product/<slug>' => 'product/slug',
                    'catalog/<slugGaz>/<slug>' => 'product/slug',
                    'catalog/index' => 'catalog/index',
                    'catalog/<slug>' => 'catalog/gas',
                    'page/<slug>' => 'page/index',
                [
                    'pattern' => 'products',
                    'route' => 'redirector/index',
                    'defaults' => ['url' => '/catalog',],
                ],[
                    'pattern' => 'sensors',
                    'route' => 'redirector/index',
                    'defaults' => ['url' => '/manufacture',],
                ],
            ],
        ],
    ],
    'params' => $params,

    'as redirector' => [
        'class' => MyBehavior::class,
    ],

];
