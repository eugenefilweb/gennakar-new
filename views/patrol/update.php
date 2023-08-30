<?php

use app\models\search\PatrolSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Patrol */

$this->title = 'Update Patrol: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = $model->breadcrumb;
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = $model->searchModel;
$this->params['activeMenuLink'] = $model->activeMenuLink;
$this->params['headerButtons'] = $model->createButton;
?>
<div class="patrol-update-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>