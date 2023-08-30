<?php

use app\models\search\DirectorySearch;

/* @var $this yii\web\View */
/* @var $model app\models\Directory */

$this->title = 'Create Directory';
$this->params['breadcrumbs'][] = ['label' => 'Directories', 'url' => ['card']];
$this->params['breadcrumbs'][] = ['label' => 'List', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new DirectorySearch();
$this->params['activeMenuLink'] = '/directory/card';
?>
<div class="directory-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>