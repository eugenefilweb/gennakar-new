<?php

use app\models\search\LocalGovernmentUnitSearch;

/* @var $this yii\web\View */
/* @var $model app\models\LocalGovernmentUnit */

$this->title = 'Create Local Government Unit';
$this->params['breadcrumbs'][] = ['label' => 'Local Government Units', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new LocalGovernmentUnitSearch();
$this->params['wrapCard'] = false;
?>
<div class="local-government-unit-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>