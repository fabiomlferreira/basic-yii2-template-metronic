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
use yii\widgets\Menu;
use yii\helpers\Url;

/** @var \Da\User\Model\User $user */
$user = Yii::$app->user->identity;
$networksVisible = count(Yii::$app->authClientCollection->clients) > 0;
?>

<div class="kt-portlet kt-portlet--height-fluid">
    <div class="kt-portlet__body">
        <div class="kt-card-profile">
            <div class="kt-card-profile__title kt-hide">
                <?= Yii::t('backend', 'Your profile') ?>
            </div>
            <div class="kt-card-profile__pic">
                <div class="kt-card-profile__pic-wrapper">	
                    <img src="<?= Yii::$app->user->identity->profile->getUserImage() ?>" alt="<?= Yii::t('backend', 'Profile Image') ?>"/>
                </div>
            </div>
            <div class="kt-card-profile__details">
                <span class="kt-card-profile__name"><?= Html::encode(Yii::$app->user->identity->completeName) ?></span>
                <a href="" class="kt-card-profile__email kt-link"><?= Html::encode(Yii::$app->user->identity->email)?></a>
            </div>
        </div>	
        <ul class="kt-nav kt-nav--hover-bg kt-portlet-fit--sides">
            <li class="kt-nav__separator kt-nav__separator--fit"></li>
            <li class="kt-nav__section kt-hide">
                <span class="mkt-nav__section-text"><?= Yii::t('backend', 'Section') ?></span>
            </li>
            <li class="kt-nav__item">
                <a href="<?= Url::to(['/user/settings/profile'])    ?>" class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon-profile-1"></i>
                    <span class="kt-nav__link-title">  
                        <span class="kt-nav__link-wrap">      
                            <span class="kt-nav__link-text"><?= Yii::t('backend', 'My Profile') ?></span>      
                            <!--<span class="kt-nav__link-badge"><span class="kt-badge kt-badge--success">2</span></span>  -->
                        </span>
                    </span>
                </a>
            </li>
            <li class="kt-nav__item">
                <a href="<?= Url::to(['/user/settings/account']) ?>" class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon-share"></i>
                    <span class="kt-nav__link-text"><?= Yii::t('backend', 'Account information') ?></span>
                </a>
            </li>
            <?php if($networksVisible): ?>
                <li class="kt-nav__item">
                    <a href="<?= Url::to(['/user/settings/networks']) ?>" class="kt-nav__link">
                        <i class="kt-nav__link-icon flaticon-chat-1"></i>
                        <span class="kt-nav__link-text"><?= Yii::t('usuario', 'Networks') ?></span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>			
</div>	
