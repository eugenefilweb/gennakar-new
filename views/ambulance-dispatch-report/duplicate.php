<?php

use app\models\search\AmbulanceDispatchReportSearch;

/* @var $this yii\web\View */
/* @var $model app\models\AmbulanceDispatchReport */

$this->title = 'Duplicate Ambulance Dispatch Report: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Ambulance Dispatch Reports', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new AmbulanceDispatchReportSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="ambulance-dispatch-report-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>