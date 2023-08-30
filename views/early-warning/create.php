<?php

use app\models\search\EarlyWarningSearch;

/* @var $this yii\web\View */
/* @var $model app\models\EarlyWarning */

$this->title = 'Create Early Warning';
$this->params['breadcrumbs'][] = ['label' => 'Early Warnings', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new EarlyWarningSearch();
?>
<div class="early-warning-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>