<?php

use app\helpers\Html;
use app\models\search\PostActivityReportSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PostActivityReport */

$this->title = 'Duplicate Post Activity Report: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Post Activity Reports', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new PostActivityReportSearch([
    'searchAction' => ($model->isSiad)? ['siad']: ['mdrrmo']
]);
$this->params['wrapCard'] = false;
$this->params['searchKeywordUrl'] = ['post-activity-report/find-by-keywords', 'type' => $model->type];
$this->params['headerButtons'] = Html::a('Create New Report', ['create', 'type' => $model->type], [
    'class' => 'btn btn-success font-weight-bold'
]);
?>
<div class="post-activity-report-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>