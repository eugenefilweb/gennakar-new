<?php

use app\models\search\PatrolSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Patrol */

$this->title = 'Create Patrol';
$this->params['breadcrumbs'][] = $model->breadcrumb;
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = $model->searchModel;
$this->params['activeMenuLink'] = $model->activeMenuLink;
?>
<div class="patrol-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>