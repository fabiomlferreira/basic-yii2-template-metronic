<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $models app\models\Config[] */

$this->title = Yii::t('backend', 'Updated configuration of Homepage');
$this->params['breadcrumbs'][] = Yii::t('backend', 'Updated configuration of Homepage');
$this->params['hideSubHeader'] = true;
?>
<div class="row">
    <div class="col-xl-12">
        <!--begin::Portlet-->
        <div class="kt-portlet " id="m_portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-caption">
                    <div class="kt-portlet__head-title">
                        <span class="kt-portlet__head-icon">
                            <i class="flaticon-edit"></i>
                        </span>
                        <h3 class="kt-portlet__head-text ">
                            <?= Html::encode($this->title) ?>
                        </h3>
                    </div>			
                </div>
            </div>
            <?php $form = ActiveForm::begin([
                'options' => ['class' => 'kt-form kt-form--label-right', 'errorCssClass' => 'has-danger'],
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-7\">{input}{error}\n{hint}</div>",
                        //'template' => "{label}\n<div class=\"col-7 input-group input-group-md kt-input-group\">{input}\n{error}\n{hint}</div>",
                        'labelOptions' => ['class' => 'col-3 col-form-label'],
                        'inputOptions' => ['class' => 'form-control kt-input'],
                        'options' => ['class' => 'form-group kt-form__group row'],
                        'hintOptions' => ['class' => 'kt-form__help', 'tag' => 'span'],
                        'errorOptions' => ['class' => 'form-control-feedback'],
                    
                    ],
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                    'errorCssClass' => 'has-danger',
                    'validationStateOn' => ActiveForm::VALIDATION_STATE_ON_CONTAINER
            ]); ?>
                <div class="kt-portlet__body">
                    <?php 
                    foreach($models as $model):
                        $field = $model->getInputField($form, true);
                        $field->label($model->name);
                        if($model->type == app\models\Config::TYPE_CURRENCY)
                            $field->template="{label}\n<div class=\"col-7 input-group kt-input-group\"><div class=\"input-group-append\"><span class=\"input-group-text\"><i class=\"fa fa-euro-sign\"></i></span></div>{input}\n{error}\n{hint}</div>";
                        if($model->type == app\models\Config::TYPE_PERCENTAGE)
                            $field->template="{label}\n<div class=\"col-7 input-group kt-input-group\"><div class=\"input-group-append\"><span class=\"input-group-text\"><i class=\"fa fa-percentage\"></i></span></div>{input}\n{error}\n{hint}</div>";
                        echo $field;
                        
                        //echo $model->name;
                    endforeach; ?>
                </div>
                <div class="kt-portlet__foot kt-portlet__foot--fit">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-3">
                            </div>
                            <div class="col-7">
                                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>

        </div>	
        <!--end::Portlet-->
    </div>
</div>