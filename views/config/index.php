<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Configurations');
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
                       <a href="<?= Url::to(['create']) ?>" class="btn btn-default btn-pill btn-sm btn-icon-md">
                           <i class="flaticon-add"></i>
                           <span><?= Yii::t('backend', 'Create configurations') ?></span>
                       </a>
                   </div>
               </div>
            </div>
            <div class="kt-portlet__body">
            <?= GridView::widget([
            'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'id',
                    [
                        'attribute' => 'type',
                        'value' => function ($model, $key, $index, $widget) {
                            return $model->typeLabel;
                        },
                    ],
                    
                    'name',
                    //'slug',
                    // 'options:ntext',
                    'value:ntext',
                    'group',
                    // 'created_at',
                    // 'updated_at',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
            </div>
        </div>	
        <!--end::Portlet-->
    </div>
</div>

