<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;

/**
 * @var yii\web\View               $this
 * @var yii\bootstrap4\ActiveForm     $form
 * @var \Da\User\Form\SettingsForm $model
 */

$this->title = Yii::t('usuario', 'Account settings');
$this->params['breadcrumbs'][] = $this->title;

/** @var \Da\User\Module $module */
$module = Yii::$app->getModule('user');
?>
<div class="clearfix"></div>

<?php // $this->render('/shared/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-xl-3 col-lg-4">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-xl-9 col-lg-8">
        <div class="kt-portlet">
            <?php $form = ActiveForm::begin(
                [
                    'id' => $model->formName(),
                    'options' => ['class' => 'kt-form kt-form--label-right', 'errorCssClass' => 'has-danger'],
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-7\">{input}{error}\n{hint}</div>",
                        'labelOptions' => ['class' => 'col-2 col-form-label'],
                        'inputOptions' => ['class' => 'form-control m-input'],
                        'options' => ['class' => 'form-group m-form__group row'],
                        'hintOptions' => ['class' => 'kt-form__help', 'tag' => 'span'],
                        'errorOptions' => ['class' => 'form-control-feedback'],

                    ],
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                    'errorCssClass' => 'has-danger',
                    'validationStateOn' => ActiveForm::VALIDATION_STATE_ON_CONTAINER
                ]
            ); ?>
                <div class="kt-portlet__body">
                    <div class="form-group kt-form__group row">
                        <div class="col-10 ml-auto">
                            <h3 class="kt-form__section">1. Dados da Conta</h3>
                        </div>
                    </div>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'username') ?>

                    <?= $form->field($model, 'new_password')->passwordInput() ?>

                    <div class="kt-form__seperator kt-form__seperator--dashed kt-form__seperator--space-2x"></div>

                    <?= $form->field($model, 'current_password')->passwordInput() ?>
                   
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-7">
                                <?= Html::submitButton(Yii::t('usuario', 'Save'), ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
        <?php if ($module->enableTwoFactorAuthentication): ?>
            <div class="kt-portlet">
                <div class="modal fade" id="tfmodal" tabindex="-1" role="dialog" aria-labelledby="tfamodalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">
                                    <?= Yii::t('usuario', 'Two Factor Authentication (2FA)') ?></h4>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    <?= Yii::t('usuario', 'Close') ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= Yii::t('usuario', 'Two Factor Authentication (2FA)') ?></h3>
                    </div>
                    <div class="panel-body">
                        <p>
                            <?= Yii::t('usuario', 'Two factor authentication protects you against stolen credentials') ?>.
                        </p>
                        <div class="text-right">
                            <?= Html::a(
                                Yii::t('usuario', 'Disable two factor authentication'),
                                ['two-factor-disable', 'id' => $model->getUser()->id],
                                [
                                    'id' => 'disable_tf_btn',
                                    'class' => 'btn btn-warning ' . ($model->getUser()->auth_tf_enabled ? '' : 'hide'),
                                    'data-method' => 'post',
                                    'data-confirm' => Yii::t('usuario', 'This will disable two factor authentication. Are you sure?'),
                                ]
                            ) ?>
                            <?= Html::a(
                                Yii::t('usuario', 'Enable two factor authentication'),
                                '#tfmodal',
                                [
                                    'id' => 'enable_tf_btn',
                                    'class' => 'btn btn-info ' . ($model->getUser()->auth_tf_enabled ? 'hide' : ''),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#tfmodal'
                                ]
                            ) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($model->module->allowAccountDelete): ?>
            <div class="kt-portlet">
                <div class="kt-form kt-form--label-right">
                    <div class="kt-portlet__body">
                        <div class="form-group kt-form__group row">
                            <div class="col-10 ml-auto">
                                <h3 class="kt-form__section">2. <?= Yii::t('usuario', 'Delete account') ?></h3>
                            </div>
                        </div>
                        <div class="form-group kt-form__group row">
                            <div class="col-10 ml-auto">
                                <p>
                                    <?= Yii::t('usuario', 'Once you delete your account, there is no going back') ?>.
                                    <?= Yii::t('usuario', 'It will be deleted forever') ?>.
                                    <?= Yii::t('usuario', 'Please be certain') ?>.
                                </p>
                            </div>
                        </div>
                    </div>  
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-2">
                                </div>
                                <div class="col-7">
                                    <?= Html::a(
                                        Yii::t('usuario', 'Delete account'),
                                        ['delete'],
                                        [
                                            'class' => 'btn btn-danger',
                                            'data-method' => 'post',
                                            'data-confirm' => Yii::t('usuario', 'Are you sure? There is no going back'),
                                        ]
                                    ) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>
<?php if ($module->enableTwoFactorAuthentication): ?>

    <?php
    // This script should be in fact in a module as an external file
    // consider overriding this view and include your very own approach
    $uri = Url::to(['two-factor', 'id' => $model->getUser()->id]);
    $verify = Url::to(['two-factor-enable', 'id' => $model->getUser()->id]);
    $js = <<<JS
$('#tfmodal')
    .on('show.bs.modal', function(){
        if(!$('img#qrCode').length) {
            $(this).find('.modal-body').load('{$uri}');
        } else {
            $('input#tfcode').val('');
        }
    });

$(document)
    .on('click', '.btn-submit-code', function(e) {
       e.preventDefault();
       var btn = $(this);
       btn.prop('disabled', true);
       
       $.getJSON('{$verify}', {code: $('#tfcode').val()}, function(data){
          btn.prop('disabled', false);
          if(data.success) {
              $('#enable_tf_btn, #disable_tf_btn').toggleClass('hide');
              $('#tfmessage').removeClass('alert-danger').addClass('alert-success').find('p').text(data.message);
              setTimeout(function() { $('#tfmodal').modal('hide'); }, 2000);
          } else {
              $('input#tfcode').val('');
              $('#tfmessage').removeClass('alert-info').addClass('alert-danger').find('p').text(data.message);
          }
       }).fail(function(){ btn.prop('disabled', false); });
    });
JS;

    $this->registerJs($js);
    ?>
<?php endif; ?>
