<?php

$this->title = 'Meetings: Minutes';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['activeMenuLink'] = '/meeting/minutes';
?>
<div class="meeting-minutes-page">
    <?= $this->render('_card-template', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'attribute' => 'minutesFiles',
    ]) ?>
</div>