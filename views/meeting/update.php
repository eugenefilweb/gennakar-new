<?php

use app\models\search\MeetingSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Meeting */

$this->title = 'Update '. ($model->isSpecial ? 'Special': '') .' Meeting: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = [
    'label' => $model->isSpecial ? 'Special Meetings': 'Meetings', 
    'url' => $model->isSpecial ? ['special']: $model->indexUrl
];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new MeetingSearch();
$this->params['showCreateButton'] = true; 
$this->params['activeMenuLink'] = $model->isSpecial ? '/meeting/special': '/meeting';
$this->params['createTitle'] = 'Create ' . ($model->isSpecial ? 'Special ': '') . ' Meeting';
?>
<div class="meeting-update-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>