<?php
use yii\bootstrap4\Html;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* @var yii\web\View $this */
/* @var \app\models\user\PermissionForm $model */
/* @var \yii\bootstrap4\ActiveForm; $form */


$permissionsByRole = \yii\helpers\Json::encode($model->getPermissionsPerRole());
        
$permissionsJS = <<<JS
    var permissionsByRole = $permissionsByRole;
    console.log(permissionsByRole);
    //$("#permissionform-superadmin").prop('disabled','disabled');
    
    function updatePermissions(isUpdate, e){
        /*console.log($('#permissionform-admin').prev().is(":checked"));
        console.log($('#permissionform-admin').is(":checked"));
        console.log($('#permissionform-admin').prev().val());
        console.log($('#permissionform-admin').val());
        console.log($('#permissionform-admin').prev().is(":visible"));
        console.log($('#permissionform-admin').is(":visible"));*/
        //console.log($("input[type='checkbox'][name='PermissionForm[superAdmin]']").is(":checked"));
        if(e !== null)
            console.log($(e).is(":checked"));
        if(isUpdate){
            //$('.form-check-input').hide();
            //$(".permissions_holder input[type='checkbox']").removeAttr("checked");
            $(".permissions_holder .form-check-input").prop('checked',false);
           // $('.permissions_holder .form-check-input').removeAttr("checked");
        }
        $('.form-check-input').prop("disabled", false);
        if ($('#permissionform-superadmin').is(":checked")){
            console.log("superAdmin");
            for (var i in permissionsByRole['superAdmin']) {
                var permission = permissionsByRole['superAdmin'];
                $("#permissionform-"+permission[i].toLowerCase()).prop('checked',true);
                $("#permissionform-"+permission[i].toLowerCase()).prop('disabled','disabled');
            }
        }
        if ($('#permissionform-admin').is(":checked")){
            console.log("admin");
            for (var i in permissionsByRole['admin']) {
                var permission = permissionsByRole['admin'];
                $("#permissionform-"+permission[i].toLowerCase()).prop('checked',true);
                $("#permissionform-"+permission[i].toLowerCase()).prop('disabled','disabled');
            }
        }
        if ($('#permissionform-manager').is(":checked")){
            console.log("manager");
            for (var i in permissionsByRole['manager']) {
                var permission = permissionsByRole['manager'];
                $("#permissionform-"+permission[i].toLowerCase()).prop('checked',true);
                $("#permissionform-"+permission[i].toLowerCase()).prop('disabled','disabled');
            }
        }
        if ($('#permissionform-user').is(":checked")){
            console.log("user");
            for (var i in permissionsByRole['user']) {
                var permission = permissionsByRole['user'];
                $("#permissionform-"+permission[i].toLowerCase()).prop('checked',true);
                $("#permissionform-"+permission[i].toLowerCase()).prop('disabled','disabled');
            }
        }
    }
JS;
$this->registerJs($permissionsJS, \yii\web\View::POS_END, 'permissionsJS');
$permissionsOnLoadJS = <<<JS
    updatePermissions(false, null);
JS;
$this->registerJs($permissionsOnLoadJS, \yii\web\View::POS_LOAD, 'permissionsOnLoadJS');

$checkboxOptions = [
    'template' => '{label}<div class="col-6"><span class="kt-switch kt-switch--icon"><label>{input}<span></span></label></span>{error}{hint}</div>', 
    /*'inputOptions' => ['type' => 'checkbox'],*/
    'labelOptions' => ['class' => 'col-6 col-form-label'],
];

?>
<?= Html::activeHiddenInput($model, 'user_id') ?>

    <div class="form-group kt-form__group row">
        <div class="col-10 ml-auto">
            <h3 class="kt-form__section"><?= $roleNumber?>. <?= Yii::t('backend', 'User Role') ?></h3>
        </div>
    </div>
<?php if(Yii::$app->user->can('adminApp')): ?>
        <div class="row">
            <?php if(Yii::$app->user->can('adminFullApp')): ?>
                <div class="col-md-6 ">
                    
                    <?= $form->field($model, 'superAdmin', $checkboxOptions)->checkbox(array_merge ($checkboxOptions, ['onchange' => 'updatePermissions(true, this);', 'class' => 'form-check-input'])); ?>
                </div>
            <?php endif; ?>
            <?php if(Yii::$app->user->can('adminApp')): ?>
                <div class="col-md-6">
                    <?= $form->field($model, 'admin', $checkboxOptions)->checkbox(array_merge ($checkboxOptions, ['onchange' => 'updatePermissions(true)', 'class' => 'form-check-input'])); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-6">
                <?= $form->field($model, 'manager', $checkboxOptions)->checkbox(array_merge ($checkboxOptions, ['onchange' => 'updatePermissions(true)', 'class' => 'form-check-input'])); ?>
        </div> 
        <div class="col-6">
            <?= $form->field($model, 'user', $checkboxOptions)->checkbox(array_merge ($checkboxOptions, ['onchange' => 'updatePermissions(true)', 'class' => 'form-check-input'])); ?>
        </div>
    </div>
    <div class="kt-form__seperator kt-form__seperator--dashed kt-form__seperator--space-2x"></div>
    <div class="form-group kt-form__group row">
        <div class="col-10 ml-auto">
            <h3 class="kt-form__section"><?= $permissionsNumber ?>. <?= Yii::t('backend', 'Permissions') ?></h3>
        </div>
    </div>
    <div class="permissions_holder">

        <div class="row">
            <div class="col-6">
                    <?= $form->field($model, 'manageApp', $checkboxOptions)->checkbox(array_merge($checkboxOptions, ['class' => 'form-check-input']));?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'manageUsers', $checkboxOptions)->checkbox(array_merge($checkboxOptions, ['class' => 'form-check-input']));?>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <?= $form->field($model, 'accessUser', $checkboxOptions)->checkbox(array_merge($checkboxOptions, ['class' => 'form-check-input']));?>
            </div>
        </div>
    </div>