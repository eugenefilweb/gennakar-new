<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\BulkAction;
use app\widgets\FilterColumn;
use app\widgets\Grid;

$queryParams = App::queryParams();
array_unshift($queryParams, "print-report");

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\LocalGovernmentUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Local Government Units';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['showCreateButton'] = false; 
$this->params['showExportButton'] = true;



$this->params['headerButtons'] = Html::tag('div', implode(' ', [
    ($dataProvider->models ? Html::popupCenter('Print Report', Url::toRoute($queryParams), ['class' => 'btn btn-primary font-weight-bolder']): ''),
    Html::a('Add New LGU', ['create'], ['class' => 'btn btn-success font-weight-bolder  ml-2'])
]), ['class' => 'd-flex align-items-end']);

?>
<div class="local-government-unit-index-page">
    <?= FilterColumn::widget(['searchModel' => $searchModel]) ?>
    <?= Html::beginForm(['bulk-action'], 'post'); ?>
        <?= BulkAction::widget(['searchModel' => $searchModel]) ?>
        
        <?= Grid::widget([
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]); ?>
    <?= Html::endForm(); ?> 
</div>