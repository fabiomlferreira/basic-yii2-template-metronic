<?php
/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use Da\User\Widget\ConnectWidget;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/**
 * @var yii\web\View            $this
 * @var \Da\User\Form\LoginForm $model
 * @var \Da\User\Module         $module
 */
$this->title = Yii::t('backend', 'Sign in on admin area');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="kt-login__wrapper">
    <?= $this->render('/shared/_alert', ['module' => Yii::$app->getModule('user')]) ?>
    <div class="kt-login__signin">
        <div class="kt-login__head">
            <h3 class="kt-login__title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="kt-login__form">
            <?php
                $form = ActiveForm::begin(
                    [
                        'id' => $model->formName(),
                        'enableAjaxValidation' => true,
                        'enableClientValidation' => false,
                        'validateOnBlur' => false,
                        'validateOnType' => false,
                        'validateOnChange' => false,
                        'options' => ['class' => 'kt-form'],
                    ]
                )
            ?>

            <?=
            $form->field(
                $model, 'login', [
                    'options' => ['class' => 'form-group'] ,
                    'inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1', 'placeholder' => Yii::t('backend', 'Username')]]
            )->label(false)
            ?>

            <?=
                $form
                ->field(
                        $model, 'password', [
                            'options' => ['class' => 'form-group'] ,
                            'inputOptions' => ['class' => 'form-control form-control-last', 'tabindex' => '2', 'placeholder' => Yii::t('backend', 'Password')]]
                )
                ->passwordInput()
                ->label(false)
            ?>
        
            <div class="row kt-login__extra">
                <div class="col kt-align-left">
                    <label class="kt-checkbox">
                        <?= Html::activeCheckbox($model, 'rememberMe', ['label' => Yii::t('backend', 'Remember me')]) ?>
                        <span></span>
                    </label>
                </div>
                <?php if($module->allowPasswordRecovery): ?>
                    <div class="col kt-align-right">
                        <?= Html::a(Yii::t('backend', 'Did you forget your password?'), ['/user/recovery/request'], ['id' => 'kt_login_forget_password', 'class' =>'kt-link' ])?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="kt-login__actions">
                <?=
                Html::submitButton(
                        Yii::t('backend', 'Sign in'), ['class' => 'btn btn-brand btn-pill btn-elevate', 'tabindex' => '3']
                )
                ?>
            </div>
            

            <?php ActiveForm::end(); ?>
        </div>
        
    </div>
</div>
