<?php

use app\models\Directory;
use app\models\search\DirectorySearch;

/* @var $this yii\web\View */
/* @var $model app\models\Directory */

$this->title = 'Duplicate Directory: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Directories', 'url' => ['card']];
$this->params['breadcrumbs'][] = ['label' => 'List', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new DirectorySearch();
$this->params['headerButtons'] = Directory::createButton();
$this->params['activeMenuLink'] = '/directory/card';
?>
<div class="directory-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>