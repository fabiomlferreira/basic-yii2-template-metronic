<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>
<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid  kt-error-v1" style="background-image: url(<?= Url::to(["/public_assets/media//error/bg1.jpg"]) ?>);">
        <div class="kt-error-v1__container">
            <h1 class="kt-error-v1__number"><?= Html::encode(Yii::$app->response->statusCode) ?></h1>
            <p class="kt-error-v1__desc">
                <?= nl2br(Html::encode($this->title)) ?>
            </p>
            <p class="kt-error-v1__desc">
                <?= nl2br(Html::encode($message)) ?>
            </p>
        </div>
        
    </div>
</div>