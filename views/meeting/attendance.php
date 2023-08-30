<?php

$this->title = 'Meetings: Attendance';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['activeMenuLink'] = '/meeting/attendance';
?>
<div class="meeting-attendance-page">
    <?= $this->render('_card-template', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'attribute' => 'attendanceFiles',
    ]) ?>
</div>