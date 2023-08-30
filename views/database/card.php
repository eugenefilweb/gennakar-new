<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\Database;
use app\widgets\DatabaseCard;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DatabaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Priority Sectors Category';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['activeMenuLink'] = '/database';
$this->params['headerButtons'] = Html::a('View All Records', ['database/member'], [
	'class' => 'btn btn-success font-weight-bolder'
]);
?>

<div class="database-index-page">
	<?= DatabaseCard::widget([
		'data_report' => $searchModel->getDataReport($dataProviderReport)
	]) ?>
</div>
