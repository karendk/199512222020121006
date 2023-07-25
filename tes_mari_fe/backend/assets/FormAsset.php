<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class FormAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugin/select2/select2.min.css',
        'plugin/datepicker/bootstrap-datepicker.min.css',
        // 'plugin/timedropper/timedropper.css'
        'plugin/timedropper/timedropper-jquery-custom.css',
        // 'plugin/signature_pad-4.1.5/docs/css/signature-pad.css',
    ];
    public $js = [
        'plugin/select2/select2.min.js',
        'plugin/datepicker/bootstrap-datepicker.min.js',
        'plugin/ckeditor5-build-classic/ckeditor.js',
        // 'plugin/timedropper/timedropper.js',
        'plugin/timedropper/timedropper-jquery.js',
        'plugin/signature_pad-4.1.5/dist/signature_pad.umd.min.js',
        'plugin/signature_pad-4.1.5/docs/js/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}