<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\models\Menu;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<?php $form = ActiveForm::begin([
        'options' => ['class' => 'kt-form kt-form--label-right', 'errorCssClass' => 'has-danger'    ],
        'fieldConfig' => [
            //'template' => "{label}\n<div class=\"input-group\">{input}</div>{error}\n{hint}",
            'template' => "{label}\n{input}\n{error}\n{hint}",
            'labelOptions' => ['class' => ''],
            'inputOptions' => ['class' => 'form-control'],
            'options' => ['class' => 'form-group'],
            'hintOptions' => ['class' => 'form-text text-muted', 'tag' => 'span'],
            'errorOptions' => ['class' => 'form-control-feedback'],

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
            <?= $form->field($model, 'position')->dropDownList(
                $model->getPositionOptions()
        ) ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6">
            <?= $form->field($model, 'parent_id',['template' =>  "{label}\n<div class=\"input-group kt-input-group\">{input}<div class=\"input-group-append\"><span class=\"input-group-text\"><i class=\"flaticon-user-add\"></i></span></div></div>{error}\n{hint}"])->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Menu::find()->orderBy('title')->all(), 'id', 'title'),
                    'theme' => Select2::THEME_DEFAULT,
                    'options' => ['placeholder' => Yii::t('app', '- Select the menu -')],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width' => 'calc(100% - 49px)' 
                    ],
                ]);
            ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <!--<div class="form-group m-form__group row">
        <div class="col-sm-6">
            <?= $form->field($model, 'lang')->textInput(['maxlength' => true]) ?>
        </div>
    </div>-->
    <div class="form-group row">
        <div class="col-sm-6">
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6">
            <?= $form->field($model, 'order')->textInput() ?>
        </div>
    </div>
    <!--<div class="form-group m-form__group row">
        <div class="col-sm-6">
            <?php /* $form->field($model, 'permission')->dropDownList(
                    $model->getPermissionOptions()
               )*/ 
            ?>
        </div>
    </div>-->
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


