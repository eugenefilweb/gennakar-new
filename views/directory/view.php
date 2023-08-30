<?php

use app\models\Directory;
use app\models\search\DirectorySearch;
use app\widgets\Anchors;
use app\widgets\Detail;

/* @var $this yii\web\View */
/* @var $model app\models\Directory */

$this->title = 'Directory: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Directories', 'url' => ['card']];
$this->params['breadcrumbs'][] = ['label' => 'List', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new DirectorySearch();
$this->params['headerButtons'] = Directory::createButton();
$this->params['activeMenuLink'] = '/directory/card';
?>
<div class="directory-view-page">
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?> 
    <?= Detail::widget(['model' => $model]) ?>
</div>