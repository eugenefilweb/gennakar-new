<?php

use app\models\search\LocalGovernmentUnitSearch;

/* @var $this yii\web\View */
/* @var $model app\models\LocalGovernmentUnit */

$this->title = 'Duplicate Local Government Unit: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Local Government Units', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new LocalGovernmentUnitSearch();
$this->params['showCreateButton'] = true; 
$this->params['wrapCard'] = false;
$this->params['createTitle'] = 'Add New LGU';
?>
<div class="local-government-unit-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>