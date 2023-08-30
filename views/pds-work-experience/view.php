<?php

use app\widgets\Anchors;
use app\widgets\Detail;
use app\models\search\PdsWorkExperienceSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PdsWorkExperience */

$this->title = 'Pds Work Experience: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Pds Work Experiences', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new PdsWorkExperienceSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="pds-work-experience-view-page">
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?> 
    <?= Detail::widget(['model' => $model]) ?>
</div>