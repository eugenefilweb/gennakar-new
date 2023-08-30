<?php

use app\helpers\App;
use app\helpers\Html;

$this->title = 'Camp Management';
$this->params['breadcrumbs'][] = $this->title;
$this->params['activeMenuLink'] = '/plan/camp-management';
$this->params['wrapCard'] = false;
?>

<?= Html::tag('iframe', '', [
	'width' => '100%',
	// 'height' => '100vh',
	'frameborder' => '0',
	'src' => App::baseUrl($file->location),
	'style' => 'height: 75vh'
]) ?>
