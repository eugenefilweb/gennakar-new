<?php

use app\models\search\PdsCivilServiceSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PdsCivilService */

$this->title = 'Update Pds Civil Service: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Pds Civil Services', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new PdsCivilServiceSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="pds-civil-service-update-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>