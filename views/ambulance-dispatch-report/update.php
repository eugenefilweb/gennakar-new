<?php

use app\models\search\AmbulanceDispatchReportSearch;

/* @var $this yii\web\View */
/* @var $model app\models\AmbulanceDispatchReport */

$this->title = 'Update Ambulance Dispatch Report: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Ambulance Dispatch Reports', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new AmbulanceDispatchReportSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="ambulance-dispatch-report-update-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>