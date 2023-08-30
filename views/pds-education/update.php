<?php

use app\models\search\PdsEducationSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PdsEducation */

$this->title = 'Update Pds Education: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Pds Educations', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new PdsEducationSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="pds-education-update-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>