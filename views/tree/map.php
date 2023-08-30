<?php

use app\helpers\App;
use app\helpers\ArrayHelper;
use app\helpers\Html;
use app\helpers\Url;
use app\models\Tree;
use app\models\search\TreeSearch;
use app\widgets\ActiveForm;
use app\widgets\Filter;
use app\widgets\LinkPager;
use app\widgets\OpenLayer;
use app\widgets\SearchButton;
use \yii\data\Pagination;

$this->title = 'Trees: Map';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['showCreateButton'] = true; 
$this->params['activeMenuLink'] = '/tree/map';
$this->params['wrapCard'] = false;
?>
<div class="tree-map-index-page">
    <div class="row">
        <div class="col-md-8">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Map View',
                'toolbar' => '<div class="card-toolbar">
                    <span class="lead font-weight-bold">Trees Found: '. number_format($total) .'</span>
                    '. Html::popupCenter('Print Report', Url::toRoute(['tree/print-map-report?']) . http_build_query(App::queryParams()), [
                        'class' => 'btn btn-success font-weight-bold ml-10'
                    ]) .'
                </div>',
                'stretch' => true
            ]) ?>
                <?= OpenLayer::widget([
                    'coordinates' => $coordinates,
                    'zoom' => $searchModel->map_zoom_level,
                ]) ?>
            <?php $this->endContent() ?>
        </div>
        <div class="col-md-4">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Advanced Filter',
            ]) ?>
                    <?php $form = ActiveForm::begin(['id' => 'tree-form', 'method' => 'get', 'action' => ['tree/map']]); ?>
                        <div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true" style="height: 60vh">
                            <div class="accordion accordion-solid accordion-toggle-plus" id="accordion-filter">
                                <?= App::foreach($searchModel->advancedFilterAttributes, fn ($attribute) => $this->render('_map-advanced-filter', [
                                    'form' => $form,
                                    'searchModel' => $searchModel,
                                    'attribute' => $attribute
                                ])) ?>

                                <?= $this->render('_map-advanced-filter', [
                                    'form' => $form,
                                    'searchModel' => $searchModel,
                                    'attribute' => 'status',
                                    'data' => [
                                        Tree::VALIDATED => 'Validated',
                                        Tree::NOT_VALIDATED => 'Not Validated',
                                    ]
                                ]) ?>

                                <label for="map_zoom_level" class="mt-3">Map Zoom Level</label>
                                <div>
                                    <input type="range" id="map_zoom_level" name="map_zoom_level" 
                                         min="1" max="20" value="<?= $searchModel->map_zoom_level  ?>" step="1" style="width: -webkit-fill-available;">
                                </div>

                                <?= LinkPager::widget([
                                    'options' => [
                                        'class' => 'mt-5 justify-content-center app-linkpager d-flex flex-wrap justify-content-center py-2'
                                    ],
                                    'pagination' => new Pagination(['totalCount' => $dataProvider->totalCount])
                                ]) ?>
                            </div>
                        </div>
                        <div class="mt-5">
                            <?= SearchButton::widget() ?>
                        </div>
                    <?php ActiveForm::end(); ?>
            <?php $this->endContent() ?>
        </div>
    </div>
</div>