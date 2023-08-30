<?php

use app\widgets\TinyMce;

$this->params['withHeader'] = false;

$this->registerCss(<<< CSS
	
CSS);
?>
<h4 class="mb-10 font-weight-bold text-dark">
    Generated Printed Report
</h4>

<?= TinyMce::widget([
	'content_style' => <<< CSS
		.page-break-before-avoid {
			page-break-after: avoid;
		}
	CSS,
	'content' => $this->render('_weather-report', [
		'model' => $model
	])
]) ?>