<?php

use app\helpers\Html;
use app\models\search\UserSearch;
use app\widgets\Anchor;
use app\widgets\Anchors;
use app\widgets\Detail;
use app\widgets\QRCode;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'User: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new UserSearch();
$this->params['showCreateButton'] = true; 
$this->params['wrapCard'] = false;

$usage = $model->bandwidthUsage;
?>
<div class="user-view-page">
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model,
    ]) ?>  
    <?= Anchor::widget([
    	'title' => 'Profile', 
    	'link' => ['profile', 'slug' => $model->slug],
    	'options' => ['class' => 'btn btn-success']
    ]) ?>
    <?= Anchor::widget([
        'title' => 'User Dashboard', 
        'link' => ['user/dashboard', 'slug' => $model->slug],
        'options' => [
            'class' => 'btn btn-warning',
            'data-method' => 'post',
            'data-confirm' => 'Your account will be logout!'
        ]
    ]) ?>
    <?= Anchor::widget([
        'title' => 'User Activities', 
        'link' => ['log/index', 'userSlug' => $model->slug],
        'options' => ['class' => 'btn btn-secondary']
    ]) ?>

    <div class="my-2"></div>

    <div class="row">
        <div class="col-md-6">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Account Details'
            ]) ?>
                <?= Detail::widget([
                    'model' => $model,
                    'options' => [
                        'class' => 'detail-view table table-active table-bordered table-striped mt-0',
                        'style' => 'overflow-wrap: anywhere;'
                    ]
                ]) ?>
            <?php $this->endContent() ?>
        </div>
        <div class="col-md-6">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Google Authenticator',
            ]) ?>
                <div class="text-center">
                    <?= Html::img($model->qRCodeurl, [
                        'class' => 'img-thumbnail symbol'
                    ]) ?>

                    <?php # QRCode::widget(['path' => $model->qRCodeurl]) ?>
                    <p class="lead font-weight-bold mt-10">Scan These QR Code to add to Google Authenticator</p>
                </div>
            <?php $this->endContent() ?>

            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Bandwidth Usage',
            ]) ?>
                <table class="detail-view table table-active table-bordered table-striped mt-0">
                    <tbody>
                        <tr>
                            <th>Resources</th>
                            <td><?= $usage['_totalBandwidth'] ?></td>
                        </tr>
                        <tr>
                            <th>Uploads</th>
                            <td><?= $usage['_totalUploads'] ?></td>
                        </tr>
                        <tr>
                            <th>Downloads</th>
                            <td><?= $usage['_totalDownloads'] ?></td>
                        </tr>
                        <tr>
                            <th>total</th>
                            <td><?= $usage['_total'] ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php $this->endContent() ?>
        </div>
    </div>
</div>