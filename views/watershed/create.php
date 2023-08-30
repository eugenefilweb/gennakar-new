<?php

use app\models\search\WatershedSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Watershed */

$this->title = 'Create Watershed';
$this->params['breadcrumbs'][] = ['label' => 'Watersheds', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new WatershedSearch();
?>
<div class="watershed-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>