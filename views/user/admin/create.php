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
use yii\bootstrap4\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use dosamigos\fileupload\FileUpload;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View        $this
 * @var \Da\User\Model\User $user
 * @var \app\models\user\Profile $profile
 * @var \app\models\user\PermissionForm $permissions
 * 
 */

$this->title = Yii::t('usuario', 'Create a user account');
$this->params['breadcrumbs'][] = ['label' => Yii::t('usuario', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<?= $this->render(
    '/shared/_alert',
    [
        'module' => Yii::$app->getModule('user'),
    ]
) ?>
<!--Begin::Section-->
<div class="row">
    <div class="col-xl-3 col-lg-4">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__body">
                <ul class="kt-nav kt-nav--hover-bg kt-portlet-fit--sides">
                    <li class="kt-nav__item">
                        <a href="<?= Url::to(['/user/admin/create']) ?>" class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon-share"></i>
                            <span class="kt-nav__link-title">  
                                <span class="kt-nav__link-wrap">      
                                    <span class="kt-nav__link-text"><?= Yii::t('usuario', 'Account details') ?></span>      
                                </span>
                            </span>
                        </a>
                    </li>
                    <li class="kt-nav__item disabled" onclick="return false;">
                        <a href="#" class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon-profile-1"></i>
                            <span class="kt-nav__link-text"><?= Yii::t('usuario', 'Profile details') ?></span>
                        </a>
                    </li>
                    <li class="kt-nav__item disabled" onclick="return false;">
                        <a href="#" class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon-information"></i>
                            <span class="kt-nav__link-text"><?= Yii::t('usuario', 'Information') ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-lg-8">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__body">
                <?= $this->render('/shared/_menu') ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="alert alert-info">
                                    <?= Yii::t('usuario', 'Credentials will be sent to the user by email') ?>.
                                    <?= Yii::t(
                                        'usuario',
                                        'A password will be generated automatically if not provided'
                                    ) ?>.
                                </div>
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
                                ); 
                                ?>
                                <div class="form-group kt-form__group row">
                                    <div class="col-10 ml-auto">
                                        <h3 class="kt-form__section">1. Dados da Conta</h3>
                                    </div>
                                </div>
                                <?= $this->render('_user', ['form' => $form, 'user' => $user]) ?>
                                <div class="kt-form__seperator kt-form__seperator--dashed kt-form__seperator--space-2x"></div>
                                <div class="form-group kt-form__group row">
                                    <div class="col-10 ml-auto">
                                        <h3 class="kt-form__section">2. Dados do Perfil</h3>
                                    </div>
                                </div>
                                <?= $form->field($profile, 'name') ?>
                                                    
                                <div class="form-group kt-form__group row field-profile-image-id">
                                    <label class="col-2 col-form-label" for="profile-image-id">Imagem</label>
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
                                        echo Html::button('<i id="loading-spinner" class="fas fa-spinner fa-spin kt-margin-r-10 kt-hide"></i>Carregar imagem', ['onclick' => '$("#fileUploadButton-image_id").click();', 'class' => 'btn btn-primary']);

                                        ?>

                                    </div>
                                </div>
                                <?php /* $form->field($profile, 'entity_id')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(\app\models\Entity::find()->where(['is_municipio' => true])->orderBy('name')->all(), 'id', 'name'),
                                    'theme' => Select2::THEME_DEFAULT,
                                    'options' => ['placeholder' => '- Escolha um município -'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);*/
                                ?>
                                
                                <div class="kt-form__seperator kt-form__seperator--dashed kt-form__seperator--space-2x"></div>
                                <?= $this->render('_permissionsform', ['form' => $form, 'model' => $permissions, 'roleNumber' => 3, 'permissionsNumber' => 4]) ?>
                                
                                <div class="kt-portlet__foot kt-portlet__foot--fit" style="margin-right: -28.600px; margin-left: -28.600px;"></div>
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-2">
                                        </div>
                                        <div class="col-7">
                                            <?= Html::submitButton(Yii::t('usuario', 'Save'), ['class' => 'btn btn-success']) ?>
                                        </div>
                                    </div>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>          
            </div>
        </div>	
        <!--end::Portlet-->
    </div>
</div>
<!--End::Section-->
