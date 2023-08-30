<?php

use app\models\search\AmbulanceDispatchReportSearch;

/* @var $this yii\web\View */
/* @var $model app\models\AmbulanceDispatchReport */

$this->title = 'Create Ambulance Dispatch Report';
$this->params['breadcrumbs'][] = ['label' => 'Ambulance Dispatch Reports', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new AmbulanceDispatchReportSearch();
?>
<div class="ambulance-dispatch-report-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>