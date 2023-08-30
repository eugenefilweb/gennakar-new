<?php

use app\models\search\VehicularAccidentReportSearch;

/* @var $this yii\web\View */
/* @var $model app\models\VehicularAccidentReport */

$this->title = 'Update Vehicular Accident Report: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Vehicular Accident Reports', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new VehicularAccidentReportSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="vehicular-accident-report-update-page">
	<?= $this->render('_form-step', [
        'model' => $model,
        'tab' => $tab,
    ]) ?>
</div>