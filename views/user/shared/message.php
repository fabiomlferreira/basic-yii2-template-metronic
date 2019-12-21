<?php
use yii\bootstrap4\Html;
/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

/**
 * @var yii\web\View
 * @var \Da\User\Module $module
 * @var string          $title
 */
$this->title = $title;
?>
<div class="kt-login__content">
    <div class="kt-login__signin">
        <?=
        $this->render(
                '_alert', [
            'module' => $module,
                ]
        );
        ?>
        <div class="kt-login__actions">
            <?= Html::a(Yii::t('backend', 'Go back'),["/"], ['class' => 'btn btn-brand btn-pill btn-elevate', 'style' => 'line-height: 28px;']); ?>
        </div>
    </div>
</div>

