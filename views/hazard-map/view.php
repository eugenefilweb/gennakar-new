<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\HazardMap;
use app\models\search\HazardMapSearch;
use app\widgets\Anchors;
use app\widgets\Detail;

/* @var $this yii\web\View */
/* @var $model app\models\HazardMap */

$this->title = 'Hazard Map: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Hazard Maps', 'url' => ['card']];
$this->params['breadcrumbs'][] = ['label' => $model->typeLabel, 'url' => HazardMap::getRoute($model->type)];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new HazardMapSearch();
$this->params['headerButtons'] = HazardMap::createButton();
$this->params['activeMenuLink'] = $model->activeMenuLink;
$this->params['wrapCard'] = false;
?>
<div class="hazard-map-view-page">
    <?php $this->beginContent('@app/views/layouts/_card_wrapper.php') ?>
        <?= Anchors::widget([
        	'names' => ['update', 'duplicate', 'delete', 'log'], 
        	'model' => $model
        ]) ?> 
    <?php $this->endContent() ?>
    
        <div class="row">
            <div class="col-md-6">
                <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                    'title' => 'Main Information',
                    'stretch' => true
                ]) ?>
                    <?= Detail::widget(['model' => $model]) ?>
                <?php $this->endContent() ?>
            </div>
            <div class="col-md-6">
                <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                    'title' => 'Main Photo',
                    'toolbar' => Html::tag('div', Html::a('Map Editor', ['file/viewer', 'token' => $model->photo], [
                            'class' => 'btn btn-success font-weight-bold'
                        ]), ['class' => 'card-toolbar'])
                ]) ?>
                <div class="text-center">
                    <?= Html::image($model->photo, ['w' => 500], [
                        'class' => 'img-fluid symbol'
                    ]) ?>
                </div>
                <?php $this->endContent() ?>
            </div>
        </div>
    <div class="my-5"></div>
    <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
        'title' => 'Gallery'
    ]) ?>
        <div class="row">
            <?= App::foreach($model->files, function ($file) {
                $img = Html::image($file, ['w' => 500], ['class' => 'img-fluid symbol']);
                $editor = Html::a('<i class="fas fa-map-marker-alt"></i> Map Editor', $file->viewerUrl, [
                            'class' => 'btn btn-success btn-sm',
                            'title' => 'Map Editor',
                            'target' => '_blank',
                            'data-toggle' => 'tooltip'
                        ]);
                return <<< HTML
                    <div class="col-md-3">
                        {$img}
                        <div class="text-center">
                            {$editor}
                        </div>
                    </div>
                HTML;
            }) ?>
        </div>
    <?php $this->endContent() ?>
</div>