<?php

$this->title = 'Meetings: Resolutions';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['activeMenuLink'] = '/meeting/resolutions';
?>
<div class="meeting-resolutions-page">
    <?= $this->render('_card-template', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'attribute' => 'resolutionsFiles',
    ]) ?>
</div>