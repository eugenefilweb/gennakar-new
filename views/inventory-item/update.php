<?php

use app\models\search\InventoryItemSearch;

/* @var $this yii\web\View */
/* @var $model app\models\InventoryItem */

$this->title = 'Update Inventory Item: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Overview', 'url' => ['overview']];
$this->params['breadcrumbs'][] = ['label' => 'Inventory Items', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new InventoryItemSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="inventory-item-update-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>