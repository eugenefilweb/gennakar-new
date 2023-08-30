<?php

use app\helpers\App;
use app\helpers\Html;
?>

<tr>
	<td colspan="11" class="font-size-1_1rem bg-gray text-white">
		<em>
			<b>VI. VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S </b>
		</em>
	</td>
</tr>

<tr class="bg-light-gray">
	<td colspan="4" rowspan="2" class="text-center">
		<div class="d-flex align-items-baseline">
			<div class="pt-0">29.</div>
			<div class="text-center line-height-sm ml-15">
				NAME & ADDRESS OF ORGANIZATION
				<div><small>(Write in full)</small></div>
			</div>
		</div>
	</td>
	<td colspan="2" class="text-center ">
		<div>INCLUSIVE DATES </div>
		<div class="line-height-sm"><small>(mm/dd/yyyy)</small> </div>
	</td>
	<td rowspan="2" class="text-center line-height-sm"> NUMBER OF HOURS </td>
	<td colspan="4" rowspan="2" class="text-center"> POSITION / NATURE OF WORK </td>
</tr>
<tr class="bg-light-gray">
	<td colspan="2" class="p-0">
		<table border="1">
			<tbody>
				<tr>
					<td class="text-center border-top-hidden border-left-hidden border-bottom-hidden" width="50%">From</td>
					<td class="text-center border-top-hidden border-right-hidden border-bottom-hidden">To</td>
				</tr>
			</tbody>
		</table>
	</td>
</tr>

<?= App::foreach($model->voluntaryWorks, fn ($voluntaryWork) => Html::tag('tr', implode('', [
	Html::tag('td', $voluntaryWork->theValue('nameAddress'), ['class' => 'text-center', 'colspan' => 4]),
	Html::tag('td', <<< HTML
		<table border="1" style="height: 30px;">
			<tbody>
				<tr>
					<td class="text-center border-top-hidden border-left-hidden border-bottom-hidden" width="50%">
						{$voluntaryWork->theValue('from')}
					</td>
					<td class="text-center border-top-hidden border-right-hidden border-bottom-hidden">
						{$voluntaryWork->theValue('to')}
					</td>
				</tr>
			</tbody>
		</table>
	HTML, ['colspan' => '2', 'class' => 'p-0']),
	Html::tag('td', $voluntaryWork->theValue('no_of_hours'), ['class' => 'text-center']),
	Html::tag('td', $voluntaryWork->theValue('position'), ['class' => 'text-center', 'colspan' => 4]),
]), ['class' => 'row-height line-height-sm'])) ?>