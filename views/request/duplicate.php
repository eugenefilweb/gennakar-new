<?php

use app\models\search\RequestSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Request */

$this->title = 'Duplicate Request: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Requests', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new RequestSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="request-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>