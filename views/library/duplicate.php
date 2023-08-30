<?php

use app\models\search\LibrarySearch;

/* @var $this yii\web\View */
/* @var $model app\models\Library */

$this->title = 'Duplicate Library: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Libraries', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new LibrarySearch();
$this->params['showCreateButton'] = true; 
?>
<div class="library-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>