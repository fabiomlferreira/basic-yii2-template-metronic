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
use yii\bootstrap4\ActiveForm;

/**
 * @var yii\web\View               $this
 * @var yii\bootstrap4\ActiveForm    $form
 * @var \Da\User\Form\RecoveryForm $model
 */

$this->title =  Yii::t('backend', 'Recover your password');
$this->params['breadcrumbs'][] = $this->title; 
?>

<div class="kt-login__wrapper">
    <div class="kt-login__signin">
        <div class="kt-login__head">
            <h3 class="kt-login__title"><?= Yii::t('backend', 'Did you forget your password?')?></h3>
            <div class="kt-login__desc"><?= Yii::t('backend', 'Enter your email to reset your password:')?></div>
        </div>
        <div class="kt-login__form">
            <?php $form = ActiveForm::begin(
                [
                    'id' => $model->formName(),
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                    'options' => ['class' => 'kt-form'],
                ]
            ); ?>
                <?=
                $form->field(
                    $model, 'email', [
                        'options' => ['class' => 'form-group'] ,
                        'inputOptions' => ['class' => 'form-control', 'tabindex' => '1', 'placeholder' => 'Email']]
                )->label(false)
                ?>

            <div class="kt-login__actions">
                <?= Html::submitButton(Yii::t('usuario', 'Continue'), ['class' => 'btn btn-brand btn-pill btn-elevate']) ?>
                <?= Html::a(Yii::t('usuario', 'Cancel'), ['/login'], ['class' => 'btn btn-outline-brand btn-pill', 'style' => 'line-height: 28px;']) ?>
            </div>

            <?php ActiveForm::end(); ?> 
        </div>
    </div>
</div>
