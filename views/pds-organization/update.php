<?php

use app\models\search\PdsOrganizationSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PdsOrganization */

$this->title = 'Update Pds Organization: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Pds Organizations', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new PdsOrganizationSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="pds-organization-update-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>