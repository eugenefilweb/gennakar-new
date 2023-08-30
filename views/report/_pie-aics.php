<?php

use app\widgets\PieChart;
?>
<div class="d-flex justify-content-around">
	<div class="">
		<?= PieChart::widget([
			'width' => 400,
			'data' => [
				'Medical Assistance (AICS- Medical Procedure )' => $data['total_medical'],
				'Medical Assistance (AICS - Medicine)' => $data['total_financial'],
				'Medical Assistance (AICS - Laboratory)' => $data['total_laboratory_request'],
			]
		]) ?>
	</div>
	<div class="">
		<?= PieChart::widget([
			'width' => 350,
			'data' => [
				'Male' => $data['total_male'],
				'Female' => $data['total_female'],
			]
		]) ?>
	</div>
</div>