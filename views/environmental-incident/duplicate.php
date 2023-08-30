<?php

use app\models\search\EnvironmentalIncidentSearch;

/* @var $this yii\web\View */
/* @var $model app\models\EnvironmentalIncident */

$this->title = 'Duplicate Environmental Incident: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Environmental Incidents', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new EnvironmentalIncidentSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="environmental-incident-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>