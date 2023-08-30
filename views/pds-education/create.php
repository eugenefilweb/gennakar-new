<?php

use app\models\search\PdsEducationSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PdsEducation */

$this->title = 'Create Pds Education';
$this->params['breadcrumbs'][] = ['label' => 'Pds Educations', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new PdsEducationSearch();
?>
<div class="pds-education-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>