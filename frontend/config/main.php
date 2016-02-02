<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'forum' => [
            'class' => 'frontend\modules\forum\Forum',
        ],
    ],
    'components' => [
        'urlManager' => [
            'showScriptName' => false,
            'enablePrettyUrl' => false,
            'rules' => [
                //Forum
                'forum/topic/<id_topic:\d+>/posts' => 'forum/default/posts',
                'forum/category/<id_category:\d+>/topics' => 'forum/default/topics',
                
                //User
                'profil/<username:\w+>' => '/user/index',
                'profil' => '/user/index',
                
                //Site
                '/' => 'site/index',
                'contact' => 'site/contact'
            ]
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
