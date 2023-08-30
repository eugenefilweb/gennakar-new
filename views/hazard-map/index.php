<?php

use app\helpers\Html;
use app\models\HazardMap;
use app\widgets\BulkAction;
use app\widgets\FilterColumn;
use app\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\HazardMapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Hazard Maps: {$title}";
$this->params['breadcrumbs'][] = ['label' => 'Hazard Maps', 'url' => ['card']];
$this->params['breadcrumbs'][] = $title;
$this->params['searchModel'] = $searchModel; 
$this->params['headerButtons'] = $headerButtons;
?>
<div class="hazard-map-index-page">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
            'tag' => 'div',
            'class' => 'row',
            'id' => 'list-wrapper',
        ],
        'summaryOptions' => [
            'class' => 'col-12'
        ],
        'beforeItem' => function ($model, $key, $index, $widget) {
            return '<div class="col-md-3">';
        },
        'afterItem' => function ($model, $key, $index, $widget) {
            return '</div>';
        },
        'layout' => "{summary}\n{items}\n<div class='col-12'>{pager}</div>",
        'itemView' => '_hazard-map',
    ]) ?>
</div>