<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\models\search\LibrarySearch;
use app\widgets\Anchors;
use app\widgets\Detail;

/* @var $this yii\web\View */
/* @var $model app\models\Library */

$this->title = 'Library: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Libraries', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new LibrarySearch();
$this->params['showCreateButton'] = true; 
$this->addJsFile('js/library', [App::setting('system')->themeModel->description]); 
?>
<div class="library-view-page">
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?> 
    <div class="row">
        <div class="col-md-6">
            <?= Detail::widget(['model' => $model]) ?>
        </div>
        <div class="col-md-6">
            <p class="lead font-weight-bold">Gallery</p>
            <?= App::foreach($model->gallery, 
                fn($token) => Html::tag('a', Html::image($token, ['w' => 200], [
                    'class' => 'img-fluid m-2 symbol',
                    'style' => 'height: 150px'
                ]), [
                    'href' => Url::toRoute(['file/viewer', 'token' => $token]),
                    'target' => '_blank'
                ])
            ) ?>
        </div>
    </div>
    <div class="row">   
        <div class="col-md-12">
            <p class="lead font-weight-bold mt-5">Location</p>
            <div id="location-data" class="tree-demo"> </div>
            <div data-id="<?= $model->id ?>" id="library-form"></div>
        </div>
    </div>
</div>