<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Config */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<?php $form = ActiveForm::begin([
        'options' => ['class' => 'kt-form kt-form--label-right', 'errorCssClass' => 'has-danger'    ],
        'fieldConfig' => [
            //'template' => "{label}\n<div class=\"input-group\">{input}</div>{error}\n{hint}",
            'template' => "{label}\n{input}\n{error}\n{hint}",
            'labelOptions' => ['class' => ''],
            'inputOptions' => ['class' => 'form-control'],
            'options' => ['class' => 'form-group validated'],
            'hintOptions' => ['class' => 'form-text text-muted', 'tag' => 'span'],
            'errorOptions' => ['class' => 'invalid-feedback'],

        ],
        //
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'validateOnBlur' => false,
        'errorCssClass' => 'has-danger',
        'validationStateOn' => ActiveForm::VALIDATION_STATE_ON_CONTAINER
    ]); ?>
<div class="kt-portlet__body">
    <div class="form-group row">
        <div class="col-sm-6">
            <?= $form->field($model, 'type')->dropDownList(
                $model->getTypeOptions()
                )
            ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6">
            <?= $form->field($model, 'group')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6">
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6">
            <?= $form->field($model, 'options')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6">
            <?php // $form->field($model, 'value')->textarea(['rows' => 6]) ?>
            <?= $model->getInputField($form) ?>
        </div>
    </div>
</div>
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <div class="row">
            <div class="col-12">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>


