<?php

use app\widgets\TinyMce;
?>

<div id="obligation-request-form-<?= $widgetId ?>">
	<?= TinyMce::widget([
		'content' => $content
	]) ?>
</div>