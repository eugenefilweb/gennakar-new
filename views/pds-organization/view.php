<?php

use app\widgets\Anchors;
use app\widgets\Detail;
use app\models\search\PdsOrganizationSearch;

/* @var $this yii\web\View */
/* @var $model app\models\PdsOrganization */

$this->title = 'Pds Organization: ' . $model->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Pds Organizations', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->mainAttribute;
$this->params['searchModel'] = new PdsOrganizationSearch();
$this->params['showCreateButton'] = true; 
?>
<div class="pds-organization-view-page">
    <?= Anchors::widget([
    	'names' => ['update', 'duplicate', 'delete', 'log'], 
    	'model' => $model
    ]) ?> 
    <?= Detail::widget(['model' => $model]) ?>
</div>