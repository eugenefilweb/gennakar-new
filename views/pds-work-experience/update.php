<?php

use app\models\search\PdsWorkExperienceSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PdsWorkExperience */

$this->title = 'Update Pds Work Experience: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Pds Work Experiences', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new PdsWorkExperienceSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="pds-work-experience-update-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>