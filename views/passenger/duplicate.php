<?php

use app\models\search\PassengerSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Passenger */

$this->title = 'Duplicate Passenger: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Passengers', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new PassengerSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="passenger-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>