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
 * @var yii\web\View             $this
 * @var \Da\User\Form\ResendForm $model
 */

$this->title = Yii::t('usuario', 'Request new confirmation message');
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

            <?= $form->field($model, 'email', ['options' => ['class' => 'form-group']])->textInput(['autofocus' => true, 'class' => 'form-control form-control-last', 'placeholder' => $model->getAttributeLabel('email')])->label(false) ?>

            <div class="kt-login__actions">
                <?= Html::submitButton(Yii::t('usuario', 'Continue'), ['class' => 'btn btn-brand btn-pill btn-elevate']) ?><br>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
