<?php

use app\models\search\PostAccidentReportSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PostAccidentReport */

$this->title = 'Update Post Accident Report: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Post Accident Reports', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new PostAccidentReportSearch();
$this->params['showCreateButton'] = true; 
$this->params['wrapCard'] = false;
?>
<div class="post-accident-report-update-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>