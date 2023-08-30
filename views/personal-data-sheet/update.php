<?php

use app\models\search\PersonalDataSheetSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalDataSheet */

$this->title = 'Update Personal Data Sheet: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Personal Data Sheets', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new PersonalDataSheetSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="personal-data-sheet-update-page">
	<?= $this->render('_form', [
        'model' => $model,
        'step' => $step,
        'step_forms' => $step_forms,
        'current_step' => $current_step,
        'action' => 'update'
    ]) ?>
</div>