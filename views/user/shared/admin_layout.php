<?php
/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use yii\bootstrap4\Html;

/**
 * @var $content string
 */
?>
<?=
$this->render(
        '/shared/_alert', [
    'module' => Yii::$app->getModule('user'),
        ]
)
?>
<!--Begin::Section-->
<div class="row">
    <div class="col-xl-12">
        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <?= $this->render('_menu') ?>
                <?= $content ?>            
            </div>
        </div>	
        <!--end::Portlet-->
    </div>
</div>
<!--End::Section-->
