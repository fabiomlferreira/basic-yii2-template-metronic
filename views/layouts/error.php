<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\web\YiiAsset;
use yii\helpers\Html;
use yii\helpers\Url;

//use yii\bootstrap4\Nav;
//use yii\bootstrap4\NavBar;
//use yii\widgets\Breadcrumbs;
//use app\widgets\Alert;

AppAsset::register($this);
$this->registerCssFile("@web/public_assets/css/pages/error/error-1.css");
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <!--begin::Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

        <!--end::Fonts -->
        <link rel="apple-touch-icon" sizes="57x57" href="/img/favicon/apple-icon-57x57.png?m=1536578467">
        <link rel="apple-touch-icon" sizes="60x60" href="/img/favicon/apple-icon-60x60.png?m=1536578467">
        <link rel="apple-touch-icon" sizes="72x72" href="/img/favicon/apple-icon-72x72.png?m=1536578467">
        <link rel="apple-touch-icon" sizes="76x76" href="/img/favicon/apple-icon-76x76.png?m=1536578467">
        <link rel="apple-touch-icon" sizes="114x114" href="/img/favicon/apple-icon-114x114.png?m=1536578467">
        <link rel="apple-touch-icon" sizes="120x120" href="/img/favicon/apple-icon-120x120.png?m=1536578467">
        <link rel="apple-touch-icon" sizes="144x144" href="/img/favicon/apple-icon-144x144.png?m=1536578467">
        <link rel="apple-touch-icon" sizes="152x152" href="/img/favicon/apple-icon-152x152.png?m=1536578467">
        <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-icon-180x180.png?m=1536578467">
        <link rel="icon" type="image/png" sizes="192x192"  href="/img/favicon/android-icon-192x192.png?m=1536578467">
        <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png?m=1536578467">
        <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon/favicon-96x96.png?m=1536578467">
        <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png?m=1536578467">
        <link rel="manifest" href="/img/favicon/manifest.json?m=1536578467">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/img/favicon/ms-icon-144x144.png?m=1536578467">
        <meta name="theme-color" content="#ffffff">
        <?php $this->head() ?>
    </head>
    <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
        <?php $this->beginBody() ?>
        <!-- begin:: Page -->
        <?= $content ?>
        <!-- end:: Page -->


        <?php $this->endBody() ?>
        <script>
            var KTAppOptions = {
                "colors": {
                    "state": {
                        "brand": "#5d78ff",
                        "dark": "#282a3c",
                        "light": "#ffffff",
                        "primary": "#5867dd",
                        "success": "#34bfa3",
                        "info": "#36a3f7",
                        "warning": "#ffb822",
                        "danger": "#fd3995"
                    },
                    "base": {
                        "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                        "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                    }
                }
            };
        </script>
    </body>
</html>
<?php $this->endPage() ?>
