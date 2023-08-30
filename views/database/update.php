<?php

use app\models\search\DatabaseSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Database */

$this->title = 'Update Database: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Databases', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = [
    'label' => $model->prioritySectorLabel, 
    'url' => ['database/member', 'priority_sector' => $model->priority_sector]
];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new DatabaseSearch();
$this->params['activeMenuLink'] = '/database';
$this->params['wrapCard'] = false;
?>

<div id="database-update-page-load" class="database-update-page">
    <?= $this->render($form, [
        'model' => $model,
    ]) ?>
</div>