<?php
use dosamigos\fileupload\FileUploadUI;
use fabiomlferreira\filemanager\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel fabiomlferreira\filemanager\models\Mediafile */

?>
<div class="row">
    <div class="col-xl-12">
        <!--begin::Portlet-->
        <div class="kt-portlet " id="kt_portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon-file-2"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Module::t('main', 'Upload manager') ?>
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col" id="uploadmanager">
                        <p><?= Html::a('← ' . Module::t('main', 'Back to file manager'), ['file/filemanager']) ?></p>
                        <?= FileUploadUI::widget([
                            'model' => $model,
                            'attribute' => 'file',
                            'clientOptions' => [
                                'autoUpload'=> Yii::$app->getModule('filemanager')->autoUpload,
                            ],
                            'clientEvents' => [
                                'fileuploadsubmit' => "function (e, data) { data.formData = [{name: 'tagIds', value: $('#filemanager-tagIds').val()}]; }",
                            ],
                            'url' => ['upload'],
                            'gallery' => false,
                            'formView' => '/file/_upload_form',
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>	
        <!--end::Portlet-->
    </div>
</div>