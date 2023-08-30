<?php

use app\models\search\PatrolSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Patrol */

$this->title = 'Duplicate Patrol: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = $model->breadcrumb;
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = $model->searchModel;
$this->params['activeMenuLink'] = $model->activeMenuLink;
$this->params['headerButtons'] = $model->createButton;
?>
<div class="patrol-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>