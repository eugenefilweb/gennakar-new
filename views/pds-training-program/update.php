<?php

use app\models\search\PdsTrainingProgramSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PdsTrainingProgram */

$this->title = 'Update Pds Training Program: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Pds Training Programs', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new PdsTrainingProgramSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="pds-training-program-update-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>