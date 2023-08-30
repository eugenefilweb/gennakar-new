<?php

use app\models\search\EnvironmentalIncidentSearch;

/* @var $this yii\web\View */
/* @var $model app\models\EnvironmentalIncident */

$this->title = 'Update Environmental Incident: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Environmental Incidents', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new EnvironmentalIncidentSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="environmental-incident-update-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>