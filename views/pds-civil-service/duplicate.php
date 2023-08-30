<?php

use app\models\search\PdsCivilServiceSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PdsCivilService */

$this->title = 'Duplicate Pds Civil Service: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Pds Civil Services', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new PdsCivilServiceSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="pds-civil-service-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>