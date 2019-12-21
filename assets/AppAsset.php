<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public_assets/plugins/global/plugins.bundle.css',
        'public_assets/css/style.bundle.css',
        'public_assets/css/skins/header/base/light.css',
        'public_assets/css/skins/header/menu/light.css',
        'public_assets/css/skins/brand/dark.css',
        'public_assets/css/skins/aside/dark.css',
    ];
    public $js = [
        //"https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js",
        'public_assets/plugins/global/plugins.bundle.js',
        'public_assets/js/scripts.bundle.js',
        //'public_assets/app/js/dashboard.js'
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
