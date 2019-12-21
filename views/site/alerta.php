<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = Yii::t('backend', 'Alert');
//$this->params['breadcrumbs'][] = ['label' => 'Alerta', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => '<div class="m-nav__link m-nav__link--icon"><span class="m-nav__link-text">'.$this->title.'</span></div>'];
//$this->params['breadcrumbs'][] = $this->title;
$this->params['hideSubHeader'] = true;
?>
<div class="row">
    <div class="col-xl-12">
        <!--begin::Portlet-->
        <div class="kt-portlet " id="kt_portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon-warning-2"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-alert m-alert--icon alert alert-danger" role="alert">
                    <div class="kt-alert__icon">
                        <i class="la la-warning"></i>
                    </div>
                    <div class="kt-alert__text">
                        <strong><?= Yii::t('backend', 'Account not corretly configurated!'); ?></strong><br>
                        <?= Yii::t('backend', 'If you are seeing this message your account is not correctly configured, contact an administrator to fix this issue.'); ?>
                    </div>	

                </div>
            </div>
        </div>	
        <!--end::Portlet-->
    </div>
</div>

