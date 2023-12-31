<?php

use app\helpers\App;
use app\widgets\Menu;
use app\helpers\Html;
?>
<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
    <!--begin::Header Logo-->
    <div class="header-logo">
        <a href="index.html">
            <?= Html::image(App::setting('image')->primary_logo, ['w' => 90, 'quality' => 90], [
                'class' => 'h-30px',
                'alt' => App::appName()
            ]) ?>
        </a>
    </div>
    <!--end::Header Logo-->
    <!--begin::Header Menu-->
    <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
        <!--begin::Header Nav-->
        <?= Menu::widget([
            'viewParams' => $this->params
        ]) ?>
        <!--end::Header Nav-->
        <?= Html::if(($searchModel = $this->params['searchModel'] ?? '') != NULL, 
            function() use($searchModel) {
                return $this->render('_header_menu_wrapper-content', [
                    'searchModel' => $searchModel,
                    'searchAction' => $searchModel->searchAction ?? ['index'],
                ]);
            }
        ) ?>
    </div>
    <!--end::Header Menu-->
</div>