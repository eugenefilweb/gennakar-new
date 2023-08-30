<?php

use app\models\HazardMap;
use app\models\search\HazardMapSearch;

/* @var $this yii\web\View */
/* @var $model app\models\HazardMap */

$this->title = 'Duplicate Hazard Map: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Hazard Maps', 'url' => ['card']];
$this->params['breadcrumbs'][] = ['label' => $model->typeLabel, 'url' => HazardMap::getRoute($model->type)];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
$this->params['searchModel'] = new HazardMapSearch();
$this->params['headerButtons'] = HazardMap::createButton();
$this->params['activeMenuLink'] = $model->activeMenuLink;
?>
<div class="hazard-map-duplicate-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>