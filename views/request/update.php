<?php

use app\models\search\RequestSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Request */

$this->title = 'Update Request: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Requests', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new RequestSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="request-update-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>