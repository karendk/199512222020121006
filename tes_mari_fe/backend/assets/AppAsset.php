<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'plugin/adminkit-3.1.0/static/css/app.css',
        'plugin/alertifyjs/css/alertify.min.css',
        'plugin/alertifyjs/css/themes/default.min.css',
        'plugin/animate/animate.min.css',
        'css/makus.css',
    ];
    public $js = [
        'plugin/adminkit-3.1.0/static/js/app.js',
        'plugin/alertifyjs/alertify.min.js',
        'js/makus.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}