<?php

use app\models\HazardMap;
use app\models\search\HazardMapSearch;

/* @var $this yii\web\View */
/* @var $model app\models\HazardMap */

$this->title = 'Create Hazard Map: ' . $model->typeLabel;
$this->params['breadcrumbs'][] = ['label' => 'Hazard Maps', 'url' => ['card']];
$this->params['breadcrumbs'][] = ['label' => $model->typeLabel, 'url' => HazardMap::getRoute($model->type)];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new HazardMapSearch();
$this->params['activeMenuLink'] = $model->activeMenuLink;
?>
<div class="hazard-map-create-page">
	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
</div>