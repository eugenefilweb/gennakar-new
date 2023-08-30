<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\search\VehicularAccidentReportSearch;
use app\widgets\Anchors;
use app\widgets\Detail;
use app\widgets\OpenLayer;

/* @var $this yii\web\View */
/* @var $model app\models\VehicularAccidentReport */

$this->title = 'Vehicular Accident Report: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Vehicular Accident Reports', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new VehicularAccidentReportSearch();
$this->params['showCreateButton'] = true; 
$this->params['wrapCard'] = false; 
$this->addCssFile('css/vehicular-accident-report', [App::identity('theme')->description]);
?>
<div class="vehicular-accident-report-view-page review-container">
    <div class="d-flex">
        <div>
            <?= Anchors::widget([
                'names' => ['update', 'duplicate', 'delete', 'log'], 
                'model' => $model
            ]) ?> 
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary font-weight-bold dropdown-toggle ml-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Print
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?= Html::popupCenter('Report', $model->printableUrl, [
                    'class' => 'dropdown-item',
                ]) ?>
                <?= Html::popupCenter('Data Privacy', $model->printableDataPrivacyUrl, [
                    'class' => 'dropdown-item',
                ]) ?>
                <?= Html::popupCenter('Attachments', $model->printableAttachmentUrl, [
                    'class' => 'dropdown-item',
                ]) ?>
            </div>
        </div>
    </div>

    <div class="my-5"></div>

    <div class="row">
        <div class="col-md-6">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'General Information',
                'stretch' => true,
            ]) ?>
                <?= $this->render('form/review/general-information', ['model' => $model]) ?>
            <?php $this->endContent() ?>
        </div>
        <div class="col-md-6">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Map Vicinity',
                'stretch' => true,
            ]) ?>
                <?= $this->render('form/review/map-vicinity', ['model' => $model]) ?>
            <?php $this->endContent() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Vehicles',
            ]) ?>
                <?= $this->render('form/review/vehicles', ['model' => $model]) ?>
            <?php $this->endContent() ?>

            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Passengers',
            ]) ?>
                <?= $this->render('form/review/passengers', ['model' => $model]) ?>
            <?php $this->endContent() ?>

            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Statements',
            ]) ?>
                <?= $this->render('form/review/statements', ['model' => $model]) ?>
            <?php $this->endContent() ?>
        </div>
    </div>
</div>