<?php

use app\helpers\App;
use app\helpers\Url;
use app\models\search\EarlyWarningSearch;
use app\widgets\Anchors;
use app\widgets\AppIcon;
use app\widgets\Detail;

/* @var $this yii\web\View */
/* @var $model app\models\EarlyWarning */

$this->title = 'Early Warning: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Early Warnings', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new EarlyWarningSearch();
$this->params['showCreateButton'] = true; 
$this->params['wrapCard'] = false; 
?>
<div class="early-warning-view-page">
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?>  

    <div class="d-flex flex-row mt-5">
        <div class="flex-row-auto offcanvas-mobile w-300px w-xl-325px" id="kt_profile_aside">
            <div class="card card-custom gutter-b card-stretch">
                <div class="card-body pt-8">
           

                    <div class="navi navi-bold navi-hover navi-active navi-link-rounded mt-10">
                        <?= App::foreach($view_tabs, function($view_tab) use($tab, $model) {
                            $url = Url::current(['tab' => $view_tab['slug']]);
                            $class = ($tab == $view_tab['slug'])? 'active': '';
                            $icon = $view_tab['icon'] != strip_tags($view_tab['icon']) ? $view_tab['icon']: AppIcon::widget(['icon' => $view_tab['icon']]);
                            return <<< HTML
                                <div class="navi-item mb-2">
                                    <a href="{$url}" class="navi-link py-4 {$class}">
                                        <span class="navi-icon mr-2">
                                            {$icon}
                                        </span>
                                        <span class="navi-text font-size-lg">
                                            {$view_tab['title']}
                                        </span>
                                    </a>
                                </div>
                            HTML;
                        }) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-row-fluid ml-lg-8">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php') ?>
                <?= $this->render("view/{$tab}", [
                    'model' => $model,
                ]) ?>
            <?php $this->endContent() ?>
        </div>
    </div>
</div>