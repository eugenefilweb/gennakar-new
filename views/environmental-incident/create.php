<?php

use app\models\search\EnvironmentalIncidentSearch;

/* @var $this yii\web\View */
/* @var $model app\models\EnvironmentalIncident */

$this->title = 'Create Environmental Incident';
$this->params['breadcrumbs'][] = ['label' => 'Environmental Incidents', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new EnvironmentalIncidentSearch();
?>
<div class="environmental-incident-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>