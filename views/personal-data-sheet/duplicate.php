<?php

use app\models\search\PersonalDataSheetSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalDataSheet */

$this->title = 'Duplicate Personal Data Sheet: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Personal Data Sheets', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new PersonalDataSheetSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="personal-data-sheet-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>