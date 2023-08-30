<?php

use app\helpers\App;
use app\helpers\Html;
?>
<tr>
	<td colspan="11" class="font-size-1_1rem bg-gray text-white">
		<em>
			<b>VIII. OTHER INFORMATION</b>
		</em>
	</td>
</tr>

<tr class="bg-light-gray">
	<td colspan="3" class="text-center">
		<div class="d-flex align-items-baseline">
			<div class="pt-0 nowrap">31.</div>
			<div class="text-center line-height-sm ml-13">
				SPECIAL SKILLS and HOBBIES
				<div><small>(mm/dd/yyyy)</small></div>
			</div>
		</div>
	</td>

	<td colspan="5" class="text-center">
		<div class="d-flex align-items-baseline">
			<div class="pt-0 nowrap">32.</div>
			<div class="text-center line-height-sm ml-25">
				NON-ACADEMIC DISTINCTIONS / RECOGNITION
				<div><small>(Write in full)</small></div>
			</div>
		</div>
	</td>

	<td colspan="3" class="text-center">
		<div class="d-flex align-items-baseline">
			<div class="pt-0 nowrap">33.</div>
			<div class="text-center line-height-sm">
				MEMBERSHIP IN ASSOCIATION/ORGANIZATION
				<div><small>(Write in full)</small></div>
			</div>
		</div>
	</td>
</tr>

<?= App::foreach($model->otherInformations['data'], fn ($data) => Html::tag('tr', implode('', [
	Html::tag('td', $data['skill'], ['class' => 'text-center', 'colspan' => 3]),
	Html::tag('td', $data['recognition'], ['class' => 'text-center', 'colspan' => 5]),
	Html::tag('td', $data['organization'], ['class' => 'text-center', 'colspan' => 3]),
]), ['class' => 'row-height line-height-sm'])) ?>