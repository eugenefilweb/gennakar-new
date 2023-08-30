<?php

$this->registerWidgetJs($widgetFunction, <<< JS
	$('#{$widgetId}').datetimepicker({$options});

	$('#{$widgetId} input').on('input', function() {
		$(this).removeClass('is-invalid');
		$(this).closest('.form-group').find('.help-block').remove();
	});
JS);
?>

<?= $form->field(
	$model, 
	$attribute, 
	[
		'template' => <<< HTML
			{label}
			<div class="input-group date" id="{$widgetId}" data-target-input="nearest">
				{input}
				<div class="input-group-append" data-target="#{$widgetId}" data-toggle="datetimepicker">
					<span class="input-group-text">
						<i class="ki ki-calendar"></i>
					</span>
				</div>
			</div>
			{error}
		HTML
	])
	->textInput([
		'class' => 'form-control datetimepicker-input',
		'placeholder' => 'Select date & time',
		'data-toggle' => 'datetimepicker',
		'autocomplete' => 'off',
		'data-target' => "#{$widgetId}",
	]) ?>
