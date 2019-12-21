<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<?= "<?php " ?>$form = ActiveForm::begin([
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
<?php foreach ($generator->getColumnNames() as $attribute):
    if (in_array($attribute, $safeAttributes)): ?>
    <div class="form-group row">
        <div class="col-sm-6">
        <?php echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n";?>
        </div>
    </div>
<?php
    endif;
endforeach; ?>
</div>
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <div class="row">
            <div class="col-12">
                <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Save') ?>, ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
</div>

<?= "<?php " ?>ActiveForm::end(); ?>


