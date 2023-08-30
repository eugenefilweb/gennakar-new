<?php

use app\widgets\Anchors;
use app\widgets\Detail;
use app\models\search\PdsTrainingProgramSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PdsTrainingProgram */

$this->title = 'Pds Training Program: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Pds Training Programs', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new PdsTrainingProgramSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="pds-training-program-view-page">
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?> 
    <?= Detail::widget(['model' => $model]) ?>
</div>