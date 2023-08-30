<?php

use app\helpers\Html;
use app\models\Role;
use app\models\search\UserSearch;
use app\widgets\Anchor;
use app\widgets\Anchors;
use app\widgets\Detail;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Patroller: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Patrollers', 'url' => ['user/patroller']];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new UserSearch([
    'searchTemplate' => 'user/_search-patroller',
    'searchAction' => ['user/index'],
    'searchLabel' => 'Patroller'
]);
$this->params['wrapCard'] = false;
$this->params['activeMenuLink'] = '/user/patroller';  
$this->params['searchKeywordUrl'] = ['user/find-by-keywords', 'role_id' => Role::PATROLLER];
$this->params['headerButtons'] = Html::a('Add New Patroller', ['user/create-patroller'], [
    'class' => 'btn btn-success font-weight-bolder'
]);

$usage = $model->bandwidthUsage;
?>
<div class="user-view-page">
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model,
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
                        'class' => 'detail-view table table-active table-bordered table-striped',
                        'style' => 'overflow-wrap: anywhere;'
                    ]
                ]) ?>
            <?php $this->endContent() ?>
        </div>
        <div class="col-md-6">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Profile'
            ]) ?>
                <?= Detail::widget(['model' => $model->profile]) ?>
            <?php $this->endContent() ?>

            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Bandwidth Usage'
            ]) ?>
                <table class="detail-view table table-active table-bordered table-striped">
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