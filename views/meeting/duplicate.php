<?php

use app\models\search\MeetingSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Meeting */

$this->title = 'Duplicate '. ($model->isSpecial ? 'Special': '') .' Meeting: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = [
    'label' => $model->isSpecial ? 'Special Meetings': 'Meetings', 
    'url' => $model->isSpecial ? ['special']: $model->indexUrl
];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new MeetingSearch();
$this->params['showCreateButton'] = true; 
$this->params['activeMenuLink'] = $model->isSpecial ? '/meeting/special': '/meeting';
$this->params['createTitle'] = 'Create ' . ($model->isSpecial ? 'Special ': '') . ' Meeting';
?>
<div class="meeting-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>