<?php

use app\models\search\EarlyWarningSearch;

/* @var $this yii\web\View */
/* @var $model app\models\EarlyWarning */

$this->title = 'Update Early Warning: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Early Warnings', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new EarlyWarningSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="early-warning-update-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>