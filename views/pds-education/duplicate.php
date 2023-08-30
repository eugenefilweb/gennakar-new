<?php

use app\models\search\PdsEducationSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PdsEducation */

$this->title = 'Duplicate Pds Education: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Pds Educations', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new PdsEducationSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="pds-education-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>