<?php

use app\models\search\PostAccidentReportSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PostAccidentReport */

$this->title = 'Create Post Accident Report';
$this->params['breadcrumbs'][] = ['label' => 'Post Accident Reports', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new PostAccidentReportSearch();
$this->params['wrapCard'] = false;
?>
<div class="post-accident-report-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>