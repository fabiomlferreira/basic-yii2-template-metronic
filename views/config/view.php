<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Config */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Configurations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['hideSubHeader'] = true;
?>
<div class="row">
    <div class="col-xl-12">
        <!--begin::Portlet-->
        <div class="kt-portlet" id="kt_portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon-file-2"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-actions">
                        
                        <!--
                        <div class="dropdown dropdown-inline">
                            <a href="#" class="btn btn-default btn-pill btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="flaticon2-add-1"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(62px, 32px, 0px);">
                                <ul class="kt-nav">
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                            <span class="kt-nav__link-text">Reports</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-send"></i>
                                            <span class="kt-nav__link-text">Messages</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                            <span class="kt-nav__link-text">Charts</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                            <span class="kt-nav__link-text">Members</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-settings"></i>
                                            <span class="kt-nav__link-text">Settings</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>-->
                        <a href="<?= Url::to(['update', 'id' => $model->id]) ?>" class="btn btn-default btn-pill btn-sm btn-icon-md">
                            <i class="flaticon-edit"></i>
                            <span><?= Yii::t('app', 'Update') ?></span>
                        </a>
                        <a href="<?= Url::to(['delete', 'id' => $model->id])?>" class="btn btn-default btn-pill btn-sm btn-icon-md" data-confirm="<?= Yii::t('app', 'Are you sure you want to delete this item?') ?>" data-method="post">
                            <i class="flaticon-delete"></i>
                            <span><?= Yii::t('app', 'delete') ?></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        ['attribute' => 'type', 'value' => $model->typeLabel],
                       'group',
                       'name',
                       'slug',
                       'options:ntext',
                       'value:ntext',
                       'created_at:datetime',
                       'updated_at:datetime',
                    ],
                ]) ?>
            </div>
        </div>	
        <!--end::Portlet-->
    </div>
</div>
