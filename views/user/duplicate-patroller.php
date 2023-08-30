<?php

use app\helpers\Html;
use app\models\Role;
use app\models\search\UserSearch;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Duplicate Patroller: ' . $originalModel->mainAttribute;
$this->params['breadcrumbs'][] = ['label' => 'Patrollers', 'url' => ['user/patroller']];
$this->params['breadcrumbs'][] = ['label' => $originalModel->mainAttribute, 'url' => $originalModel->viewUrl];
$this->params['breadcrumbs'][] = 'Duplicate';
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
?>
<div class="user-duplicate-page">
	<?= $this->render('_form-patroller', [
        'model' => $model,
    ]) ?>
</div>