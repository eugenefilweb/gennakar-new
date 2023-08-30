<?php

$this->title = 'Meetings: Photos';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['activeMenuLink'] = '/meeting/photos';
?>
<div class="meeting-photos-page">
    <?= $this->render('_card-template', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'attribute' => 'photosFiles',
    ]) ?>
</div>