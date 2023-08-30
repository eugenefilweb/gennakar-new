<?php

use app\models\search\UserSearch;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'My Password';
$this->params['breadcrumbs'][] = 'Change Password';
$this->params['searchModel'] = new UserSearch();
$this->params['activeMenuLink'] = '/my-password';
?>
<div class="user-my-password-page">
	<?= $this->render('_change_password', [
		'model' => $model,
		'user' => $user,
	]) ?>
</div>