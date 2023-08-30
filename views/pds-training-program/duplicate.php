<?php

use app\models\search\PdsTrainingProgramSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PdsTrainingProgram */

$this->title = 'Duplicate Pds Training Program: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Pds Training Programs', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new PdsTrainingProgramSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="pds-training-program-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>