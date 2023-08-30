<?php

use app\widgets\Anchors;
use app\widgets\Detail;
use app\models\search\PassengerSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Passenger */

$this->title = 'Passenger: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Passengers', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new PassengerSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="passenger-view-page">
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?> 
    <?= Detail::widget(['model' => $model]) ?>
</div>