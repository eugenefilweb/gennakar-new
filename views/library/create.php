<?php

use app\models\search\LibrarySearch;

/* @var $this yii\web\View */
/* @var $model app\models\Library */

$this->title = 'Add Library Item';
$this->params['breadcrumbs'][] = ['label' => 'Libraries', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Add Item';
$this->params['searchModel'] = new LibrarySearch();
?>
<div class="library-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>