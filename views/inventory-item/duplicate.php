<?php

use app\models\search\InventoryItemSearch;

/* @var $this yii\web\View */
/* @var $model app\models\InventoryItem */

$this->title = 'Duplicate Inventory Item: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Overview', 'url' => ['overview']];
$this->params['breadcrumbs'][] = ['label' => 'Inventory Items', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new InventoryItemSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="inventory-item-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>