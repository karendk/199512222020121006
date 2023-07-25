<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

//replace backend/web
$baseUrl=str_replace('/backend/web','',(new \yii\web\Request)->getBaseUrl());

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],

    /* -------------------------------------------------------------------------- */
    /*                                     MDM                                    */
    /* -------------------------------------------------------------------------- */
    'aliases' => [
        '@mdm/admin' => '@vendor/mdmsoft/yii2-admin',
    ],
    'modules' => [
        'rbac' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'mainLayout' => '@backend/views/layouts/main.php',
            'menus' => [
                // 'assignment' => [
                //     'label' => Yii::t('app','Grant Access') // change label
                // ],
                'permission' => null, // disable menu
                'rule' => null,
            ],
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'debug/*',
            // 'permohonan/log',
            // 'permohonan/doc',
            // 'tempat/*',
            // 'counting/*',
            'api/*',
            // 'user/*',
            // 'gii/*',
            // 'rbac/*',
            //'*',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],
    'components' => [
        'authManager' => [
            // 'class' => 'yii\rbac\PhpManager', // or use 'yii\rbac\DbManager'
            'class' => 'yii\rbac\DbManager'
            // 'defaultRoles' => ['staff'],
        ],
        /* -------------------------------------------------------------------------- */
        /*                                     MDM                                    */
        /* -------------------------------------------------------------------------- */
        'request' => [
            'csrfParam' => '_csrf-backend',
            // 'baseUrl'=>'/backend',
            'baseUrl' => $baseUrl,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'authTimeout' => 7 * 24 * 60 * 60, //10 menit
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            'timeout' => 7 * 24 * 60 * 60, // 2 weeks, 3600 - 1 hour, Default 1440
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'login' => 'site/login',
                'logout' => 'site/logout',
                'reset' => 'site/reset',
                'tes' => 'site/tes',
            ],
            // 'scriptUrl'=>'/backend/index.php',

        ],

        // 'view' => [
        //     'theme' => [
        //         'pathMap' => [
        //             '@app/views' => '@vendor/hail812/yii2-adminlte3/src/views'
        //         ],
        //     ],
        // ],

        'makus' => [
            'class' => 'common\helpers\Makus',
        ],
    ],
    'params' => $params,
];
