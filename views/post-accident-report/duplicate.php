<?php

use app\models\search\PostAccidentReportSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PostAccidentReport */

$this->title = 'Duplicate Post Accident Report: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Post Accident Reports', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new PostAccidentReportSearch();
$this->params['showCreateButton'] = true; 
$this->params['wrapCard'] = false;
?>
<div class="post-accident-report-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>