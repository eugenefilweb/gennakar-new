<?php

use app\models\search\LocalGovernmentUnitSearch;

/* @var $this yii\web\View */
/* @var $model app\models\LocalGovernmentUnit */

$this->title = 'Update Local Government Unit: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Local Government Units', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new LocalGovernmentUnitSearch();
$this->params['showCreateButton'] = true; 
$this->params['wrapCard'] = false;
$this->params['createTitle'] = 'Add New LGU';
?>
<div class="local-government-unit-update-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>