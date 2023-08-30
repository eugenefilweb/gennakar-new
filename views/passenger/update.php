<?php

use app\models\search\PassengerSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Passenger */

$this->title = 'Update Passenger: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Passengers', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new PassengerSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="passenger-update-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>