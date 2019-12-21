<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\web\YiiAsset;
use yii\helpers\Html;
use luya\bootstrap4\widgets\Breadcrumbs;
use yii\helpers\Url;

//use yii\bootstrap4\Nav;
//use yii\bootstrap4\NavBar;
//use luya\bootstrap4\widgets\Breadcrumbs;
//use app\widgets\Alert;

AppAsset::register($this);
YiiAsset::register($this);

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
        <!-- begin:: Header Mobile -->
        <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
            <div class="kt-header-mobile__logo">
                <a href="<?= Url::to(['/']) ?>">
                    <img alt="Logo" src="<?= Url::to(["/img/logo.png"]) ?>" width="200"/>
                </a>
            </div>
            <div class="kt-header-mobile__toolbar">
                <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
                <button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
                <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
            </div>
        </div>
        <!-- end:: Header Mobile -->
        <div class="kt-grid kt-grid--hor kt-grid--root">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
                <!-- begin:: Aside -->
                 <?=
                    $this->render(
                            '_left'
                    )
                ?>
                <!-- end:: Aside -->
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                    <!-- begin:: Header -->
                    <?=
                    $this->render(
                            '_header'
                    )
                    ?>
                    <!-- end:: Header -->
                    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                        <?php if(!isset($this->params['hideSubHeader']) || $this->params['hideSubHeader'] == false || isset($this->params['breadcrumbs'])): ?>
                            <!-- begin:: Content Head -->
                            <div class="kt-subheader kt-grid__item" id="kt_subheader">
                                <div class="kt-container  kt-container--fluid ">
                                    <div class="kt-subheader__main">
                                        <?php if(!isset($this->params['hideSubHeader']) || $this->params['hideSubHeader'] == false): ?>
                                            <h3 class="kt-subheader__title">
                                                <?= Html::encode($this->title) ?>
                                            </h3>
                                            <?php if(isset($this->params['breadcrumbs'])): ?>
                                                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php
                                            if(isset($this->params['breadcrumbs'])){
                                                $breadcrumbs = $this->params['breadcrumbs'];
                                                foreach ($breadcrumbs as $key => $breadcrumb){
                                                    if(!isset($breadcrumb['label'])){
                                                        unset($breadcrumbs[$key]);
                                                        $breadcrumbs[$key]['label'] = '<a href="javascript:;" class="kt-subheader__breadcrumbs-link">'.$breadcrumb.'</a>';
                                                    }else{
                                                        $breadcrumbs[$key]['label'] = '<a href="'. Url::to($breadcrumb['url']).'" class="kt-subheader__breadcrumbs-link">'.$breadcrumb['label'].'</a>';
                                                    }
                                                    if(!isset($breadcrumb['class']))
                                                        $breadcrumbs[$key]['class'] = 'kt-subheader__breadcrumbs-link';
                                                }
                                                echo Breadcrumbs::widget(
                                                    [
                                                        'encodeLabels' => false,
                                                        'homeLink'=>[
                                                            'label' => '<i class="flaticon2-shelter"></i>',  // required
                                                            'encode' => false,
                                                            'url' => Yii::$app->homeUrl,
                                                            'template' => '{link}', 
                                                            'class' => 'kt-subheader__breadcrumbs-home', 
                                                        ],
                                                        'itemTemplate' => '<span class="kt-subheader__breadcrumbs-separator"></span>{link}',
                                                        'activeItemTemplate' => '<span class="kt-subheader__breadcrumbs-separator"></span>{link}',
                                                        //'activeItemTemplate' => "<li class=\"active\">{link}</li>\n"
                                                        'options' => ['class' => 'kt-subheader__breadcrumbs'],
                                                        'tag' => 'div',
                                                        'links' => $breadcrumbs,
                                                    ]
                                                );
                                            }
                                        ?>
                                    </div>
                                    <!-- Toolbar is possible here -->
                                </div>
                            </div>
                            <!-- end:: Content Head -->
                        <?php endif; ?>
                        <!-- begin:: Content -->
                        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                            <?= \app\widgets\Alert::widget(); ?>    
                            <?= $content ?>
                        </div>
                        <!-- end:: Content -->
                    </div>
                    
                    <!-- begin:: Footer -->
                    <?=
                    $this->render(
                            '_footer'
                    )
                    ?>
                    <!-- end:: Footer -->
                </div>
            </div>
        </div>
        <!-- end:: Page -->
        <!-- begin::Quick Panel -->
        <?php /*
        $this->render(
                '_quick_sidebar'
        )*/
        ?>
        <!-- end::Quick Panel -->
        <!-- begin::Scrolltop -->
        <div id="kt_scrolltop" class="kt-scrolltop">
            <i class="fa fa-arrow-up"></i>
        </div>
        <!-- end::Scrolltop -->
        <!-- begin::Sticky Toolbar -->
        <?php /*
        $this->render(
            '_sticky_toolbar'
        )*/
        ?>
        <!-- end::Sticky Toolbar -->
        
        <!-- begin::Global Config(global config for global JS sciprts) -->
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
        <!-- end::Global Config -->
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
