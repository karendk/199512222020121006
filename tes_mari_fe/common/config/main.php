<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        // 'db' => [
        //     'class' => 'yii\db\Connection',
        //     'dsn' => 'mysql:host=localhost;dbname=tes_mari_fe_db',
        //     'username' => 'root',
        //     'password' => '',
        //     'charset' => 'utf8',
        // ],
        // 'db2' => [
        //     'class' => 'yii\db\Connection',
        //     'dsn' => 'mysql:host=localhost;dbname=tes_mari_be_db',
        //     'username' => 'root',
        //     'password' => '',
        //     'charset' => 'utf8',
        // ],
    ],
];
