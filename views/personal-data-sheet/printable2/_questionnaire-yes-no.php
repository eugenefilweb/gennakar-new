<?php

use app\helpers\Html;
?>

<div class="d-flex">
	<label class="ml-3">
		<?= Html::input('checkbox', 'checkbox', 'yes', ['checked' => $value == 'yes']) ?>
		YES
	</label>

	<label class="ml-20">
		<?= Html::input('checkbox', 'checkbox', 'no', ['checked' => $value == 'no']) ?>
		NO
	</label>
</div>