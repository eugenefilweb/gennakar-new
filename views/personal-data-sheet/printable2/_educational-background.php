<?php

use app\helpers\App;
use app\helpers\Html;
?>

<table border="1">
	<tbody>
		<tr>
			<td class="border-hidden" width="18%"></td>
			<td class="border-hidden" width="21%"></td>
			<td class="border-hidden" width="21%"></td>
			<td class="border-hidden" width="7%"></td>
			<td class="border-hidden" width="7%"></td>
			<td class="border-hidden"></td>
			<td class="border-hidden" width="9%"></td>
			<td class="border-hidden" width="9%"></td>
		</tr>

		<tr>
			<td colspan="8" class="font-size-1_1rem bg-gray text-white">
				<em>
					<b>III. EDUCATIONAL BACKGROUND</b>
				</em>
			</td>
		</tr>

		<tr class="bg-light-gray">
			<td rowspan="2">
				<div style="margin-top: -20px;">26.</div>
				<div class="text-center">LEVEL</div>
			</td>
			<td rowspan="2" class="text-center">
				<div class="line-height-sm">NAME OF SCHOOL </div>
				<div class="line-height-sm"><small>(Write in full)</small></div>
			</td>
			<td rowspan="2" class="text-center">
				<div class="line-height-sm">BASIC EDUCATION/DEGREE/COURSE</div>
				<div class="line-height-sm"><small>(Write in full) </small></div>
			</td>
			<td colspan="2" class="text-center line-height-sm">
				PERIOD OF ATTENDANCE
			</td>
			<td rowspan="2" class="text-center">
				<div class="line-height-sm">HIGHEST LEVEL/UNITS EARNED </div>
				<div class="line-height-sm"><small>(if not graduated)</small></div>
			</td>
			<td rowspan="2" class="text-center line-height-sm">YEAR GRADUATED </td>
			<td rowspan="2" class="text-center line-height-sm">SCHOLARSHIP/ ACADEMIC HONORS RECEIVED</td>
		</tr>

		<tr class="bg-light-gray">
			<td class="text-center">From</td>
			<td class="text-center">To</td>
		</tr>

		<?= App::foreach([
			'ELEMENTARY' => $model->elementaryEducations,
			'SECONDARY' => $model->secondaryEducations,
			'VOCATIONAL / TRADE COURSE' => $model->vocationalEducations,
			'COLLEGE' => $model->collegeEducations,
			'GRADUATE STUDIES' => $model->graduateStudiesEducations,
		], fn ($data, $key) => App::foreach($data, fn ($obj) => Html::tag('tr', implode('', [
			Html::tag('td', $key, ['class' => 'bg-light-gray pl-7']),
			Html::tag('td', $obj ? $obj->theValue('name'): '', ['class' => 'text-center']),
			Html::tag('td', $obj ? $obj->theValue('course'): '', ['class' => 'text-center']),
			Html::tag('td', $obj ? $obj->theValue('fromYearMonth'): '', ['class' => 'text-center']),
			Html::tag('td', $obj ? $obj->theValue('toYearMonth'): '', ['class' => 'text-center']),
			Html::tag('td', $obj ? $obj->theValue('highest_level'): '', ['class' => 'text-center']),
			Html::tag('td', $obj ? $obj->theValue('year_graduated'): '', ['class' => 'text-center']),
			Html::tag('td', $obj ? $obj->theValue('academic_honor'): '', ['class' => 'text-center']),
		]), ['class' => 'row-height line-height-sm']))
	) ?>
	</tbody>
</table>