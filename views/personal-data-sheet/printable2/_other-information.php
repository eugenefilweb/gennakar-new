<?php

use app\helpers\App;
use app\helpers\Html;
?>

<table border="1">
	<tbody>
		<tr>
			<td class="border-hidden" width="3%"></td>
			<td class="border-hidden" width="21%"></td>
			<td class="border-hidden" ></td>
			<td class="border-hidden" width="30%"></td>
			<td class="border-hidden" ></td>
			<td class="border-hidden" width="3%"></td>
			<td class="border-hidden" width="21%"></td>
		</tr>

		<tr>
			<td colspan="7" class="font-size-1_1rem bg-gray text-white">
				<em>
					<b>VIII. OTHER INFORMATION</b>
				</em>
			</td>
		</tr>

		<tr class="bg-light-gray">
			<td class="vertical-align-top border-right-hidden nowrap"> 31. </td>
			<td class="text-center line-height-sm">
				SPECIAL SKILLS and HOBBIES
			</td>
			<td class="vertical-align-top border-right-hidden nowrap"> 32. </td>
			<td class="text-center" colspan="2">
				<div>NON-ACADEMIC DISTINCTIONS / RECOGNITION</div>
				<div class="line-height-sm">
					<small>(Write in full)</small>
				</div>
			</td>
			<td class="vertical-align-top border-right-hidden nowrap"> 33. </td>
			<td class="text-center">
				<div>MEMBERSHIP IN ASSOCIATION/ORGANIZATION </div>
				<div class="line-height-sm">
					<small>(Write in full)</small>
				</div>
			</td>
		</tr>

		<?= App::foreach($model->otherInformations['data'], fn ($data) => Html::tag('tr', implode('', [
			Html::tag('td', $data['skill'], ['class' => 'text-center', 'colspan' => 2]),
			Html::tag('td', $data['recognition'], ['class' => 'text-center', 'colspan' => 3]),
			Html::tag('td', $data['organization'], ['class' => 'text-center', 'colspan' => 2]),
		]), ['class' => 'row-height line-height-sm'])) ?>

	</tbody>
</table>