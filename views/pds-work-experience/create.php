<?php

use app\models\search\PdsWorkExperienceSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PdsWorkExperience */

$this->title = 'Create Pds Work Experience';
$this->params['breadcrumbs'][] = ['label' => 'Pds Work Experiences', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new PdsWorkExperienceSearch();
?>
<div class="pds-work-experience-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>