<?php

use fabiomlferreira\filemanager\assets\FilemanagerAsset;
use fabiomlferreira\filemanager\Module;
use fabiomlferreira\filemanager\models\Tag;
use yii\helpers\ArrayHelper;
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $searchModel fabiomlferreira\filemanager\models\MediafileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->params['moduleBundle'] = FilemanagerAsset::register($this);
?>
<style>
    .list-view {
        width: 100%;
    }
    .dashboard {
        width: 100%;
    }
</style>
<div class="row">
    <div class="col-xl-12">
        <!--begin::Portlet-->
        <div class="kt-portlet " id="kt_portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon-file-2"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Module::t('main', 'File manager') ?>
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-actions">
                        <a href="<?= Url::to(['file/uploadmanager']) ?>" class="btn btn-default btn-pill btn-sm btn-icon-md">
                            <span>
                                <i class="flaticon-upload"></i>
                                <span><?= Module::t('main', 'Upload manager') ?></span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col" id="filemanager" data-url-info="<?= Url::to(['file/info'])?>">
                        <div class="row">
                            <div class="col-sm-9">
                                <?php  //$searchForm = $this->render('_search_form', ['model' => $model]) ?>
                                <?= ListView::widget([
                                    'dataProvider' => $dataProvider,
                                    //'layout' => $searchForm . '<div class="items">{items}</div>{pager}',
                                    'layout' => '<div class="items">{items}</div>{pager}',
                                    'itemOptions' => ['class' => 'item'],
                                    'itemView' => function ($model, $key, $index, $widget) {
                                                return Html::a(
                                                    Html::img($model->getDefaultThumbUrl($this->params['moduleBundle']->baseUrl))
                                                    . '<span class="checked glyphicon glyphicon-check"></span>',
                                                    '#mediafile',
                                                    ['data-key' => $key]
                                                );
                                        },
                                        'pager' => [
                                            'options' => [
                                                'class' => 'pagination',
                                                'style'=> 'display: flex;',
                                            ],
                                            'linkOptions' => ['class' => 'page-link'],
                                            'pageCssClass' => 'page-item',
                                            'prevPageCssClass' => 'page-item',
                                            'prevPageLabel' => false,
                                        ]
                                ]) ?>
                            </div>
                            <div class="dashboard col-sm-3">
                                <div id="fileinfo">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
        <!--end::Portlet-->
    </div>
</div>
