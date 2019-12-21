<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use dosamigos\fileupload\FileUpload;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View           $this
 * @var \Da\User\Model\User    $user
 * @var \Da\User\Model\Profile $profile
 */

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
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'validateOnBlur' => false,
        'errorCssClass' => 'has-danger',
        'validationStateOn' => ActiveForm::VALIDATION_STATE_ON_CONTAINER
    ]
); ?>

<?= $form->field($profile, 'name') ?>
<?php // $form->field($profile, 'image_id') ?>

<div class="form-group kt-form__group row field-profile-image-id">
    <label class="col-2 col-form-label" for="profile-image-id"><?= Yii::t('app', 'Image') ?></label>
    <div class="col-7">
        <div id="dropzone-user" class="dropzone-fileinput dropzone-fileinput__single-file" onclick="$('#fileUploadButton-image_id').click();">
            <div class="dropzone-fileinput__user">
                <img id="imagefile_temp" src="<?= $profile->getUserImage() ?>" class="dropzone-fileinput__user-img" alt="">
            </div>
        </div>
        <?= Html::activeHiddenInput($profile, 'image_id') ?>
        <?php 
        $media = new \fabiomlferreira\filemanager\models\Mediafile();
        echo FileUpload::widget([
            'model' => $media,
            'attribute' => 'file',
            'url' => ['/site/upload-files'], // your url, this is just for demo purposes,
            'options' => [
                'accept' => 'image/*',
                'style' => 'display:none',
                'id' => 'fileUploadButton-image_id',
            ],
            'clientOptions' => [
                'maxFileSize' => 5000000, // 5MB
                'autoUpload' => Yii::$app->getModule('filemanager')->autoUpload,
                //'dropZone'=> new \yii\web\JsExpression("$('#dropzone-user')"),
                //'acceptFileTypes' => '/\.(gif|jpe?g|png)$/i',
            ],
            // Also, you can specify jQuery-File-Upload events
            // see: https://github.com/blueimp/jQuery-File-Upload/wiki/Options#processing-callback-options
            'clientEvents' => [
                    'fileuploadstart' => 'function(e, data) {
                        $("#loading-spinner").removeClass("kt-hide");
                     }',
                    'fileuploaddone' => 'function(e, data) {
                        $("#imagefile_temp").attr("src", data.result.files[0].thumbnailUrl);
                        $("#profile-image_id").val(data.result.files[0].media_id);
                        console.log("Id da imagem:"+data.result.files[0].media_id);
                        $("#imagefile_temp").show();
                        //$("#candidatura-file").siblings("button.has-error").removeClass("has-error");
                        $("#loading-spinner").addClass("kt-hide");
                    }',
                    'fileuploadfail' => 'function(e, data) {
                        $("#loading-spinner").addClass("kt-hide");
                        console.log("Ocorreu um erro a carregar a imagem"); //ALTERAR ISTO
                        //console.log(e);
                        //console.log(data);
                     }',
                ],
            ]); 
            echo Html::button('<i id="loading-spinner" class="fas fa-spinner fa-spin kt-margin-r-10 kt-hide"></i>'.Yii::t('backend', 'Upload image') , ['onclick' => '$("#fileUploadButton-image_id").click();', 'class' => 'btn btn-primary']);

        ?>
        
    </div>
</div>

<?php /* $form->field($profile, 'deputado_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(\app\models\Entity::find()->where(['is_municipio' => true])->orderBy('name')->all(), 'id', 'name'),
    'theme' => Select2::THEME_DEFAULT,
    'options' => ['placeholder' => '- Escolha um município -'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);*/
?>
   
<?php // $form->field($profile, 'public_email') ?>
<?php // $form->field($profile, 'website') ?>
<?php // $form->field($profile, 'location') ?>
<?php // $form->field($profile, 'gravatar_email') ?>
<?php // $form->field($profile, 'bio')->textarea() ?>

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

<?php ActiveForm::end(); ?>

<?php $this->endContent() ?>
