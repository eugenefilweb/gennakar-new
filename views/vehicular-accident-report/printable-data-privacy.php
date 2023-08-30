<?php

use app\helpers\App;
use app\models\search\VehicularAccidentReportSearch;
use app\widgets\Anchors;

$this->title = 'Post Accident Report(Data Privacy):' . $model->mainAttribute;
$this->params['sleep'] = 100; 
$this->params['withHeader'] = false;
$this->addCssFile('css/vehicular-accident-report');
?>

<div id="printable" class="printable-data-privacy px-21">
    <?= $this->render('printable/data-privacy', ['model' => $model]) ?>
</div>