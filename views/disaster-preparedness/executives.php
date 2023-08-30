<?php

use app\models\search\DashboardSearch;
use app\widgets\TwitterPost;
use app\widgets\FacebookTimeline;

$this->title = 'Disaster Prepareness: Executives';
$this->params['breadcrumbs'][] = 'Disaster Prepareness';
$this->params['breadcrumbs'][] = 'Executives';
$this->params['searchModel'] = new DashboardSearch(); 
$this->params['activeMenuLink'] = '/disaster-preparedness/executives';
$this->params['wrapCard'] = false;
?>

<div class="dashboard-page">
	<div class="row">
		<div class="col-md-6">
			<?= TwitterPost::widget(['name' => 'rtvmalacanang', 'height' => 700]) ?>
		</div>
		<div class="col-md-6">
			<?= TwitterPost::widget(['name' => 'QuezonGovPh', 'height' => 700]) ?>
		</div>
	</div>
	<div class="my-20"></div>
	<h2>Facebook Feeds</h2>
	<div class="row">
		<div class="col-md-4">
			<?= FacebookTimeline::widget([
				'pageName' => 'Malacanang Palace',
				'pageLink' => 'https://www.facebook.com/profile.php?id=100075570858772',
				'height' => 700
			]) ?>
		</div>
		<div class="col-md-4">
			<?= FacebookTimeline::widget([
				'pageName' => 'Quezon City',
				'pageLink' => 'https://www.facebook.com/QuezonGovPh',
				'height' => 700
			]) ?>
		</div>
		<div class="col-md-4">
			<?= FacebookTimeline::widget([
				'pageName' => 'General Nakar',
				'pageLink' => 'https://www.facebook.com/GeneralNakarLGU/',
				'height' => 700
			]) ?>
		</div>
	</div>
</div>