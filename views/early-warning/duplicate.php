<?php

use app\models\search\EarlyWarningSearch;

/* @var $this yii\web\View */
/* @var $model app\models\EarlyWarning */

$this->title = 'Duplicate Early Warning: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Early Warnings', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new EarlyWarningSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="early-warning-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>