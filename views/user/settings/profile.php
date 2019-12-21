<?php
/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use Da\User\Helper\TimezoneHelper;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use dosamigos\fileupload\FileUpload;

/**
 * @var yii\web\View           $this
 * @var yii\bootstrap4\ActiveForm $form
 * @var \Da\User\Model\Profile $model
 * @var TimezoneHelper         $timezoneHelper
 */
$this->title = Yii::t('usuario', 'Profile settings');
$this->params['breadcrumbs'][] = $this->title;
$timezoneHelper = $model->make(TimezoneHelper::class);
?>


<?php // $this->render('/shared/_alert', ['module' => Yii::$app->getModule('user')])  ?>
<!--<div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
    <!--Begin:: App Aside Mobile Toggle-->
    <!--<button class="kt-app__aside-close" id="kt_user_profile_aside_close">
        <i class="la la-close"></i>
    </button>-->
    <!--End:: App Aside Mobile Toggle--><!--
    
</div>-->
<div class="row">
    <div class="col-xl-3 col-lg-4">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-xl-9 col-lg-8">
        <div class="kt-portlet kt-portlet--height-fluid">
            <?php
            $form = ActiveForm::begin(
                [
                    'id' => $model->formName(),
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
            );
            ?>
                <div class="kt-portlet__body">
                    <div class="form-group kt-form__group row">
                        <div class="col-10 ml-auto">
                            <h3 class="kt-form_se kt-form__section">1. Dados do Perfil</h3>
                        </div>
                    </div>


                    <?= $form->field($model, 'name') ?>
                                        
                    <div class="form-group kt-form__group row field-profile-image-id">
                        <label class="col-2 col-form-label" for="profile-image-id">Imagem</label>
                        <div class="col-7">
                            <div id="dropzone-user" class="dropzone-fileinput dropzone-fileinput__single-file" onclick="$('#fileUploadButton-image_id').click();">
                                <div class="dropzone-fileinput__user">
                                    <img id="imagefile_temp" src="<?= $model->getUserImage() ?>" class="dropzone-fileinput__user-img" alt="">
                                </div>
                            </div>
                            <?= Html::activeHiddenInput($model, 'image_id') ?>
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
                            echo Html::button('<i id="loading-spinner" class="fas fa-spinner fa-spin kt-margin-r-10 kt-hide"></i>Carregar imagem', ['onclick' => '$("#fileUploadButton-image_id").click();', 'class' => 'btn btn-primary']);

                            ?>

                        </div>
                    </div>
                    
                    
                    
                    <?php // $form->field($model, 'public_email') ?>

                    <?php // $form->field($model, 'website') ?>

                    <?php // $form->field($model, 'location') ?>

                    <?php /*
                        $form
                        ->field($model, 'timezone')
                        ->dropDownList(ArrayHelper::map($timezoneHelper->getAll(), 'timezone', 'name'));
                     * */
                     
                    ?>
                    <?php /*
                        $form
                        ->field($model, 'gravatar_email')
                        ->hint(
                                Html::a(
                                        Yii::t('usuario', 'Change your avatar at Gravatar.com'), 'http://gravatar.com', ['target' => '_blank']
                                )
                        )*/
                    ?>

                    <?php // $form->field($model, 'bio')->textarea() ?>

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
    </div>
</div>
