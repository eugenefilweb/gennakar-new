<?php

use app\models\search\PassengerSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Passenger */

$this->title = 'Create Passenger';
$this->params['breadcrumbs'][] = ['label' => 'Passengers', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new PassengerSearch();
?>
<div class="passenger-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>