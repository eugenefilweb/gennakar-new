<?php

use app\widgets\Anchors;
use app\widgets\Detail;
use app\models\search\InventoryItemSearch;

/* @var $this yii\web\View */
/* @var $model app\models\InventoryItem */

$this->title = 'Inventory Item: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Overview', 'url' => ['overview']];
$this->params['breadcrumbs'][] = ['label' => 'Inventory Items', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new InventoryItemSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="inventory-item-view-page">
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?> 
    <?= Detail::widget(['model' => $model]) ?>
</div>