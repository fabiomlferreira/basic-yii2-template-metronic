<?php
/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use Da\User\Model\User;
use yii\bootstrap4\Nav;
use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;
use app\helpers\NavHelper;

/**
 * @var View   $this
 * @var User   $user
 * @var string $content
 */
$this->title = Yii::t('usuario', 'Update user account')." - ".$user->getCompleteName();
$this->params['breadcrumbs'][] = ['label' => Yii::t('usuario', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clearfix"></div>
<?=
$this->render(
        '/shared/_alert', [
    'module' => Yii::$app->getModule('user'),
        ]
)
?>
<!--Begin::Section-->
<div class="row">
    <div class="col-xl-3 col-lg-4">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--full-height">
            <div class="kt-portlet__body">
                <ul class="kt-nav kt-nav--hover-bg kt-portlet-fit--sides">
                    <li class="kt-nav__item <?= NavHelper::isItemActive(['/user/admin/update', 'id' => $user->id]) ? "kt-nav__item--active" : "" ?>">
                        <a href="<?= Url::to(['/user/admin/update', 'id' => $user->id]) ?>" class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon-share"></i>
                            <span class="kt-nav__link-text"><?= Yii::t('usuario', 'Account details') ?></span>      
                        </a>
                    </li>
                    <li class="kt-nav__item <?= NavHelper::isItemActive(['/user/admin/update-profile', 'id' => $user->id]) ? "kt-nav__item--active" : "" ?>" >
                        <a href="<?= Url::to(['/user/admin/update-profile', 'id' => $user->id]) ?>" class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon-profile-1"></i>
                            <span class="kt-nav__link-text"><?= Yii::t('usuario', 'Profile details') ?></span>
                        </a>
                    </li>
                    <li class="kt-nav__item <?= NavHelper::isItemActive(['/user/admin/info', 'id' => $user->id]) ? "kt-nav__item--active" : "" ?>" >
                        <a href="<?= Url::to(['/user/admin/info', 'id' => $user->id]) ?>" class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon-information"></i>
                            <span class="kt-nav__link-text"><?= Yii::t('usuario', 'Information') ?></span>
                        </a>
                    </li>
                    <li class="kt-nav__item <?= NavHelper::isItemActive(['/user/admin/permissions', 'id' => $user->id]) ? "kt-nav__item--active" : "" ?>" >
                        <a href="<?= Url::to(['/user/admin/permissions', 'id' => $user->id]) ?>" class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon-lock"></i>
                            <span class="kt-nav__link-text"><?= Yii::t('backend', 'Permissions') ?></span>
                        </a>
                    </li>
                    <?php if(Yii::$app->user->can('adminFullApp')): ?>
                        <li class="kt-nav__item <?= NavHelper::isItemActive(['/user/admin/assignments', 'id' => $user->id]) ? "kt-nav__item--active" : "" ?>" >
                            <a href="<?= Url::to(['/user/admin/assignments', 'id' => $user->id]) ?>" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-lock"></i>
                                <span class="kt-nav__link-text"><?= Yii::t('usuario', 'Assignments') ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="kt-nav__separator kt-nav__separator--fit"></li>
                    <?php if(!$user->isConfirmed): ?>
                    <li class="kt-nav__item <?= NavHelper::isItemActive(['/user/admin/confirm', 'id' => $user->id]) ? "kt-nav__item--active" : "" ?>" >
                        <a href="<?= Url::to(['/user/admin/confirm', 'id' => $user->id]) ?>" class="kt-nav__link" data-method="post" data-confirm="<?= Yii::t('usuario', 'Are you sure you want to confirm this user?')?>">
                            <i class="kt-nav__link-icon flaticon-user-ok text-success"></i>
                            <span class="ktnav__link-text text-success"><?= Yii::t('usuario', 'Confirm') ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(!$user->isBlocked): ?>
                        <li class="kt-nav__item <?= NavHelper::isItemActive(['/user/admin/block', 'id' => $user->id]) ? "kt-nav__item--active" : "" ?>" >
                            <a href="<?= Url::to(['/user/admin/block', 'id' => $user->id]) ?>" class="kt-nav__link" data-method="post" data-confirm="<?= Yii::t('usuario', 'Are you sure you want to block this user?')?>">
                                <i class="kt-nav__link-icon flaticon-danger text-danger"></i>
                                <span class="kt-nav__link-text text-danger"><?= Yii::t('usuario', 'Block') ?></span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="kt-nav__item <?= NavHelper::isItemActive(['/user/admin/block', 'id' => $user->id]) ? "kt-nav__item--active" : "" ?>" >
                            <a href="<?= Url::to(['/user/admin/block', 'id' => $user->id]) ?>" class="kt-nav__link" data-method="post" data-confirm="<?= Yii::t('usuario', 'Are you sure you want to unblock this user?')?>">
                                <i class="kt-nav__link-icon flaticon-danger text-danger"></i>
                                <span class="kt-nav__link-text text-danger"><?= Yii::t('usuario', 'Unblock') ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="kt-nav__item <?= NavHelper::isItemActive(['/user/admin/delete', 'id' => $user->id]) ? "kt-nav__item--active" : "" ?>" >
                        <a href="<?= Url::to(['/user/admin/delete', 'id' => $user->id]) ?>" class="kt-nav__link" data-method="post" data-confirm="<?= Yii::t('usuario', 'Are you sure you want to delete this user?')?>">
                            <i class="kt-nav__link-icon flaticon-delete-1 text-danger"></i>
                            <span class="kt-nav__link-text text-danger"><?= Yii::t('usuario', 'Delete') ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-lg-8">
        <!--begin::Portlet-->
        <div class="kt-portlet ">
            <div class="kt-portlet__body">
                <?= $this->render('/shared/_menu') ?>
                <div class="row">
                    <div class="col-md-12">
                        <?= $content ?>
                    </div>
                </div>          
            </div>
        </div>	
        <!--end::Portlet-->
    </div>
</div>
<!--End::Section-->

