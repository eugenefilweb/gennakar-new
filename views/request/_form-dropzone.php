<?= \app\widgets\Dropzone::widget([
    'tag' => 'Request',
    'model' => $model,
    'attribute' => 'files',
	'sending' => <<< JS
		$(document).find('#request-form .btn-submit').prop('disabled', true);
	JS,
	'complete' => <<< JS
		$(document).find('#request-form .btn-submit').prop('disabled', false);
	JS
]) ?>