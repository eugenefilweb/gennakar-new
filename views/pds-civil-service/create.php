<?php

use app\models\search\PdsCivilServiceSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PdsCivilService */

$this->title = 'Create Pds Civil Service';
$this->params['breadcrumbs'][] = ['label' => 'Pds Civil Services', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new PdsCivilServiceSearch();
?>
<div class="pds-civil-service-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>