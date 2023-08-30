<?php

use app\models\HazardMap;
use app\models\search\HazardMapSearch;

/* @var $this yii\web\View */
/* @var $model app\models\HazardMap */

$this->title = 'Update Hazard Map: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Hazard Maps', 'url' => ['card']];
$this->params['breadcrumbs'][] = ['label' => $model->typeLabel, 'url' => HazardMap::getRoute($model->type)];
$this->params['breadcrumbs'][] = ['label' => $model->mainAttribute, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = 'Update';
$this->params['searchModel'] = new HazardMapSearch();
$this->params['headerButtons'] = HazardMap::createButton();
$this->params['activeMenuLink'] = $model->activeMenuLink;
?>
<div class="hazard-map-update-page">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>