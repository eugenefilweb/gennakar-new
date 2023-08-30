<?php

use app\models\search\StatementSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Statement */

$this->title = 'Update Statement: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Statements', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new StatementSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="statement-update-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>