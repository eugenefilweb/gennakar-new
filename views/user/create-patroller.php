<?php

use app\models\search\UserSearch;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Create Patroller';
$this->params['breadcrumbs'][] = ['label' => 'Patrollers', 'url' => ['user/patroller']];
$this->params['breadcrumbs'][] = 'Create';
$this->params['searchModel'] = new UserSearch([
    'searchTemplate' => 'user/_search-patroller',
    'searchAction' => ['user/index'],
    'searchLabel' => 'Patroller'
]);
$this->params['wrapCard'] = false;
$this->params['activeMenuLink'] = '/user/patroller';
?>
<div class="user-create-page">
	<?= $this->render('_form-patroller', [
		'model' => $model,
	]) ?>
</div>