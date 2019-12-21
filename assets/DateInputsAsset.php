<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Project assets.
 */
class DateInputsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'public_assets/js/demo1/pages/date-inputs.js'
    ];
    public $depends = [
        'app\assets\AppAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
