<?php

use app\models\search\InventoryItemSearch;

/* @var $this yii\web\View */
/* @var $model app\models\InventoryItem */

$this->title = 'Create Inventory Item';
$this->params['breadcrumbs'][] = ['label' => 'Overview', 'url' => ['overview']];
$this->params['breadcrumbs'][] = ['label' => 'Inventory Items', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new InventoryItemSearch();
?>
<div class="inventory-item-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>