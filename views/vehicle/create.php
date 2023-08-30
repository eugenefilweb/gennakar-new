<?php

use app\models\search\VehicleSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Vehicle */

$this->title = 'Create Vehicle';
$this->params['breadcrumbs'][] = ['label' => 'Vehicles', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new VehicleSearch();
?>
<div class="vehicle-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>