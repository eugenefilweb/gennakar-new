<?php

use app\models\search\MeetingSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Meeting */

$this->title = $model->isSpecial ? 'Create Special Meeting': 'Create Meeting';
$this->params['breadcrumbs'][] = [
	'label' => $model->isSpecial ? 'Special Meetings': 'Meetings', 
	'url' => $model->isSpecial? ['special']: $model->indexUrl
];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new MeetingSearch();
$this->params['activeMenuLink'] = $model->isSpecial ? '/meeting/special': '/meeting';
?>
<div class="meeting-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>