<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['hideSubHeader'] = true;
?>
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
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-actions">
                        <a href="<?= Url::to(['update', 'id' => $model->id]) ?>" class="btn btn-default btn-pill btn-sm btn-icon-md">
                            <i class="flaticon-edit"></i>
                            <span><?= Yii::t('app', 'Update') ?></span>
                        </a>
                        <a href="<?= Url::to(['delete', 'id' => $model->id])?>" class="btn btn-default btn-pill btn-sm btn-icon-md" data-confirm="<?= Yii::t('app', 'Are you sure you want to delete this item?') ?>" data-method="post">
                            <i class="flaticon-delete"></i>
                            <span><?= Yii::t('app', 'Delete') ?></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        ['attribute' => 'position', 'value' => $model->getPosition($model->position)],
                        ['attribute' => 'parent_id', 'value' => !empty($model->parent) ? $model->parent->title : null],
                        //'parent_id',
                        'title',
                        //'lang',
                        'url:url',
                        'order',
                        //['attribute' => 'permission', 'value' => $model->permissionLabel],
                        'created_at:datetime',
                        'updated_at:datetime',
                    ],
                ]) ?>
            </div>
        </div>	
        <!--end::Portlet-->
    </div>
</div>
