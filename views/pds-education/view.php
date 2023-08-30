<?php

use app\widgets\Anchors;
use app\widgets\Detail;
use app\models\search\PdsEducationSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PdsEducation */

$this->title = 'Pds Education: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Pds Educations', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new PdsEducationSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="pds-education-view-page">
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?> 
    <?= Detail::widget(['model' => $model]) ?>
</div>