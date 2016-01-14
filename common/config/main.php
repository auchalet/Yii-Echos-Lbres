<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',  
                'username' => 'alexis.michallet@gmail.com',
                'password' => '200phoenix-',
                'port' => '587', 
                'encryption' => 'tls', 
            ],            
            'useFileTransport' => false,
        ],        
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],        
    ],
];
