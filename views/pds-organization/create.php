<?php

use app\models\search\PdsOrganizationSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PdsOrganization */

$this->title = 'Create Pds Organization';
$this->params['breadcrumbs'][] = ['label' => 'Pds Organizations', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new PdsOrganizationSearch();
?>
<div class="pds-organization-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>