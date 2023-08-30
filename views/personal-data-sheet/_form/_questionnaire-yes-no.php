<?php

use app\helpers\Html;
?>

<p>
	<div class="radio-inline">
		<label class="radio">
			<?= Html::input('radio', $name ?? 'radio', 'yes', [
				'checked' => $value == 'yes'
			]) ?>
			<span></span>Yes
		</label>
		<label class="radio">
			<?= Html::input('radio', $name ?? 'radio', 'no', [
				'checked' => $value == 'no'
			]) ?>
			<span></span>No
		</label>
	</div>
</p>