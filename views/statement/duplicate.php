<?php

use app\models\search\StatementSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Statement */

$this->title = 'Duplicate Statement: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Statements', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new StatementSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="statement-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>