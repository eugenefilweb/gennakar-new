<?php

use app\models\search\StatementSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Statement */

$this->title = 'Create Statement';
$this->params['breadcrumbs'][] = ['label' => 'Statements', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new StatementSearch();
?>
<div class="statement-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>