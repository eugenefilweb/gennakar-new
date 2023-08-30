<?php

use app\models\search\PdsTrainingProgramSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PdsTrainingProgram */

$this->title = 'Create Pds Training Program';
$this->params['breadcrumbs'][] = ['label' => 'Pds Training Programs', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new PdsTrainingProgramSearch();
?>
<div class="pds-training-program-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>