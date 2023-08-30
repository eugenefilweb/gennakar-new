<?php

use app\models\search\DashboardSearch;
use app\widgets\Map;
$this->title = 'Map';
$this->params['searchModel'] = new DashboardSearch(['searchLabel' => 'Map']); 
$this->registerCss(<<< CSS
	.card.card-custom {height:  54em;}
CSS);
$this->params['createController'] = 'user'; 
$this->params['showCreateButton'] = true; 
$this->params['showExportButton'] = true;
?>
<div class="map-page">
	<?= Map::widget(['template' => 'dashboard']) ?>
</div>