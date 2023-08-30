<?php

use app\models\search\VehicularAccidentReportSearch;

/* @var $this yii\web\View */
/* @var $model app\models\VehicularAccidentReport */

$this->title = 'Duplicate Vehicular Accident Report: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Vehicular Accident Reports', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new VehicularAccidentReportSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="vehicular-accident-report-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>