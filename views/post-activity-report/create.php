<?php

use app\models\search\PostActivityReportSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PostActivityReport */

$this->title = 'Create Post Activity Report';
$this->params['breadcrumbs'][] = ['label' => 'Post Activity Reports', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new PostActivityReportSearch([
    'searchAction' => ($model->isSiad)? ['siad']: ['mdrrmo']
]);
$this->params['wrapCard'] = false;
$this->params['searchKeywordUrl'] = ['post-activity-report/find-by-keywords', 'type' => $model->type];
?>
<div class="post-activity-report-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>