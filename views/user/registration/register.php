<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View                   $this
 * @var \Da\User\Form\RegistrationForm $model
 * @var \Da\User\Model\User            $user
 * @var \Da\User\Module                $module
 */

$this->title = Yii::t('usuario', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kt-login__wrapper">
    <?= $this->render('/shared/_alert', ['module' => Yii::$app->getModule('user')]) ?>
    <div class="kt-login__signin">
        <div class="kt-login__head">
            <h3 class="kt-login__title"><?= Html::encode($this->title) ?></h3>
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

            <?= $form->field($model, 'email', ['options' => ['class' => 'form-group']])->textInput(['autofocus' => true, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('email')])->label(false) ?>

            <?= $form->field($model, 'username', ['options' => ['class' => 'form-group']])->textInput(['class' => 'form-control', 'placeholder' => $model->getAttributeLabel('username')])->label(false) ?>

            <?php if ($module->generatePasswords == false): ?>
                <?= $form->field($model, 'password', ['options' => ['class' => 'form-group']])->passwordInput(['class' => 'form-control', 'placeholder' => $model->getAttributeLabel('password')])->label(false) ?>
            <?php endif ?>

            <?php if ($module->enableGdprCompliance): ?>
                <div class="row kt-login__extra">
                    <div class="col kt-align-left">
                        <label class="kt-checkbox">
                            <?= $form->field($model, 'gdpr_consent')->checkbox(['value' => 1]) ?>
                            <span></span>
                        </label>
                    </div>
                </div>
            <?php endif ?>

            <div class="kt-login__actions">
                <?= Html::submitButton(Yii::t('usuario', 'Sign up'), ['class' => 'btn btn-brand btn-pill btn-elevate mr-0']) ?>
                <div class="row mt-2">
                    <div class="col kt-align-center">
                        <?= Html::a(Yii::t('usuario', 'Already registered? Sign in!'), ['/user/security/login'], ['class' =>'kt-link']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

