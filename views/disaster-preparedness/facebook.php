<?php

use app\models\search\DashboardSearch;
use app\widgets\TwitterPost;
use app\widgets\FacebookTimeline;

$this->title = 'Disaster Prepareness: Facebook';
$this->params['breadcrumbs'][] = 'Disaster Prepareness';
$this->params['breadcrumbs'][] = 'Facebook';
$this->params['searchModel'] = new DashboardSearch(); 
$this->params['activeMenuLink'] = '/disaster-preparedness/facebook';
$this->params['wrapCard'] = false;
?>

<div class="dashboard-page">
	<div class="row">
		<div class="col-md-6">
			<?= FacebookTimeline::widget([
				'pageName' => 'General Nakar',
				'pageLink' => 'https://www.facebook.com/GeneralNakarLGU/',
				'height' => 700
			]) ?>
		</div>
	</div>
</div>