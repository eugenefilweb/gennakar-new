<?php

use app\models\search\DashboardSearch;

$this->title = 'Community Profiling: Household Survey';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = new DashboardSearch(['searchLabel' => 'Household Survey']); 
$this->params['activeMenuLink'] = '/community-profiling/household-survey';
?>

<div class="map-page">
</div>
