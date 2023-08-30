<?php

use app\models\search\VehicularAccidentReportSearch;

/* @var $this yii\web\View */
/* @var $model app\models\VehicularAccidentReport */

$this->title = 'Create Vehicular Accident Report';
$this->params['breadcrumbs'][] = ['label' => 'Vehicular Accident Reports', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new VehicularAccidentReportSearch();
?>
<div class="vehicular-accident-report-create-page">
	<?= $this->render('_form-step', [
		'model' => $model,
		'tab' => $tab,
	]) ?>
</div>