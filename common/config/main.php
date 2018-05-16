<?php
return [
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)).'/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin'],
            'modelMap' => [
                'User' => 'common\models\User',
                'Profile' => 'common\models\Profile',
            ],
            'mailer' => [
                'sender'                => 'no-reply@myhost.com',
                'welcomeSubject'        => 'Welcome subject',
                'confirmationSubject'   => 'Confirmation subject',
                'reconfirmationSubject' => 'Email change subject',
                'recoverySubject'       => 'Recovery subject',
            ],
        ],
    ],
    'as afterAction' => [
        'class' => '\common\components\LastVisitBehavior'
    ],
];
