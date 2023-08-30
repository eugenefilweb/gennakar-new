<?php

use app\models\search\PersonalDataSheetSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalDataSheet */

$this->title = 'Create Personal Data Sheet: ' . $current_step['title'];
$this->params['breadcrumbs'][] = ['label' => 'Personal Data Sheets', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new PersonalDataSheetSearch();
?>
<div class="personal-data-sheet-create-page">
	<?= $this->render('_form', [
		'model' => $model,
		'step' => $step,
		'step_forms' => $step_forms,
		'current_step' => $current_step,
	]) ?>
</div>