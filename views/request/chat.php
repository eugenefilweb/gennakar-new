<?php

use app\widgets\WidgetBot;

$this->title = 'Chat';
$this->params['wrapCard'] = false;
$this->params['activeMenuLink'] = '/request/chat';
?>

<div class="row">
	<div class="col-md-8">
		<?= WidgetBot::widget() ?>
	</div>
	<div class="col-md-4">
		<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
			'title' => 'Request Form',
		]) ?>
			<?= $this->render('_form', [
				'model' => $model,
			]) ?>
		<?php $this->endContent() ?>
	</div>
</div>



