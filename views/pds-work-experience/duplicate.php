<?php

use app\models\search\PdsWorkExperienceSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PdsWorkExperience */

$this->title = 'Duplicate Pds Work Experience: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Pds Work Experiences', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new PdsWorkExperienceSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="pds-work-experience-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>