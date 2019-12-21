<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use Da\User\Widget\AssignmentsWidget;
//use dosamigos\multiselect\MultiSelectListBox;
use yii\web\JsExpression;
use yii\bootstrap4\Alert;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var yii\web\View $this */
/* @var Da\User\Model\User $user */
/* @var app\models\user\PermissionForm $model */


?>

<?php $this->beginContent('@Da/User/resources/views/admin/update.php', ['user' => $user]) ?>

<?php $form = ActiveForm::begin(
    [
        'options' => ['class' => 'kt-form kt-form--label-right', 'errorCssClass' => 'has-danger'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-7\">{input}{error}\n{hint}</div>",
            'labelOptions' => ['class' => 'col-2 col-form-label'],
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
    ]
);

?>

    
    
    <?= $this->render('_permissionsform', ['form' => $form, 'model' => $model, 'roleNumber' => 1, 'permissionsNumber' => 2]) ?>

    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <div class="row">
                <div class="col-2">
                </div>
                <div class="col-7">
                    <?= Html::submitButton(Yii::t('usuario', 'Update'), ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>

<?php ActiveForm::end() ?>

<?php $this->endContent() ?>
