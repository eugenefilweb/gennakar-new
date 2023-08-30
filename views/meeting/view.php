<?php

use app\widgets\Anchors;
use app\widgets\Detail;
use app\models\search\MeetingSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Meeting */

$this->title = ($model->isSpecial ? 'Special ': '') . 'Meeting: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = [
    'label' => $model->isSpecial ? 'Special Meetings': 'Meetings', 
    'url' => $model->isSpecial ? ['special']: $model->indexUrl
];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new MeetingSearch();
$this->params['showCreateButton'] = true; 
$this->params['activeMenuLink'] = $model->isSpecial ? '/meeting/special': '/meeting';
$this->params['createTitle'] = 'Create ' . ($model->isSpecial ? 'Special ': '') . ' Meeting';
?>
<div class="meeting-view-page">
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?> 
    <?= Detail::widget(['model' => $model]) ?>
</div>