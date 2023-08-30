<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\BulkAction;
use app\widgets\FilterColumn;
use app\widgets\Grid;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\InventoryItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$queryParams = App::queryParams();

array_unshift($queryParams, "print-report");

$this->title = 'Inventory Items';
$this->params['breadcrumbs'][] = ['label' => 'Overview', 'url' => ['overview']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['showExportButton'] = true;
$this->params['headerButtons'] = Html::tag('div', implode(' ', [
    ($dataProvider->models ? Html::popupCenter('Print Report', Url::toRoute($queryParams), ['class' => 'btn btn-primary font-weight-bolder']): ''),
    Html::a('Add New Item', ['create'], ['class' => 'btn btn-success font-weight-bolder  ml-2'])
]), ['class' => 'd-flex align-items-end']);
?>
<div class="inventory-item-index-page">
    <?= FilterColumn::widget(['searchModel' => $searchModel]) ?>
    <?= Html::beginForm(['bulk-action'], 'post'); ?>
        <?= BulkAction::widget(['searchModel' => $searchModel]) ?>
        
        <?= Grid::widget([
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]); ?>
    <?= Html::endForm(); ?> 
</div>