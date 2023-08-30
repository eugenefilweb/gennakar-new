<?php

use app\models\search\LibrarySearch;

/* @var $this yii\web\View */
/* @var $model app\models\Library */

$this->title = 'Update Library: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Libraries', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new LibrarySearch();
$this->params['showCreateButton'] = true; 
?>
<div class="library-update-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>