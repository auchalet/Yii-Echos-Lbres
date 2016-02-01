<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        //URL backend
        'urlManager' => [
            'showScriptName' => false,
            'enablePrettyUrl' => false,
            'hostInfo' => 'http://admin.echos.local'
        ],
        //URL frontend
        'urlManagerFrontEnd' => [
            'class' => 'yii\web\urlManager',
            'hostInfo' => 'http://echos.local/',
            'baseUrl' => 'http://echos.local/index.php?r=',
            'showScriptName' => false,
            'enablePrettyUrl' => false,
            
        ],        
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
