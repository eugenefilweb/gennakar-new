<?php

use app\models\search\RequestSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Request */

$this->title = 'Create Request';
$this->params['breadcrumbs'][] = ['label' => 'Requests', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new RequestSearch();
?>
<div class="request-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>