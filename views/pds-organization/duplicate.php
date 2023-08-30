<?php

use app\models\search\PdsOrganizationSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PdsOrganization */

$this->title = 'Duplicate Pds Organization: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Pds Organizations', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new PdsOrganizationSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="pds-organization-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>