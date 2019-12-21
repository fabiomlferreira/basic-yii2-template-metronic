<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Config */

$this->title = Yii::t('backend', 'Update configuration: '). $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Configurations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$this->params['hideSubHeader'] = true;
?>
<div class="row">
    <div class="col-xl-12">
        <!--begin::Portlet-->
        <div class="kt-portlet" id="kt_portlet">
           <div class="kt-portlet__head">
               <div class="kt-portlet__head-label">
                   <span class="kt-portlet__head-icon">
                       <i class="flaticon-edit"></i>
                   </span>
                   <h3 class="kt-portlet__head-title">
                       <?= Html::encode($this->title) ?>
                   </h3>
                </div>
            </div>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>	
        <!--end::Portlet-->
    </div>
</div>