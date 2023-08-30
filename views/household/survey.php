<?php

use app\widgets\SearchHousehold;

$this->title = 'Household Survey';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['wrapCard'] = false;
$this->params['activeMenuLink'] = '/household/survey';
?>

<div class="row">
	<div class="col-md-6">
		<?= SearchHousehold::widget([
			'title' => '<i class="fas fa-pencil-alt"></i> Search Household',
			// 'template' => 'database'
		]) ?>
	</div>
</div>	