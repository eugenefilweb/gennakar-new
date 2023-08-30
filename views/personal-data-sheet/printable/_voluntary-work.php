<?php

use app\helpers\App;
use app\helpers\Html;
?>

<table border="1">
	<tbody>
		<tr>
			<td class="border-hidden"></td>
			<td class="border-hidden"></td>
			<td class="border-hidden" width="9%"></td>
			<td class="border-hidden" width="9%"></td>
			<td class="border-hidden" width="9%"></td>
			<td class="border-hidden" width="33%"></td>
		</tr>

		<tr>
			<td colspan="6" class="font-size-1_1rem bg-gray text-white">
				<em>
					<b>VI. VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S </b>
				</em>
			</td>
		</tr>

		<tr class="bg-light-gray">
			<td rowspan="2" class="vertical-align-top border-right-hidden nowrap">
				29.
			</td>
			<td rowspan="2" class="text-center">
				NAME & ADDRESS OF ORGANIZATION 
				<div class="line-height-sm">
					<small>(Write in full)</small>
				</div>
			</td>
			<td colspan="2" class="text-center ">
				<div>INCLUSIVE DATES </div>
				<div class="line-height-sm"><small>(mm/dd/yyyy)</small> </div>
			</td>
			<td rowspan="2" class="text-center line-height-sm"> NUMBER OF HOURS </td>
			<td rowspan="2" class="text-center"> POSITION / NATURE OF WORK </td>
		</tr>
		<tr class="bg-light-gray">
			<td class="text-center">From</td>
			<td class="text-center">To</td>
		</tr>

		<?= App::foreach($model->voluntaryWorks, fn ($voluntaryWork) => Html::tag('tr', implode('', [
			Html::tag('td', $voluntaryWork->theValue('nameAddress'), ['class' => 'text-center', 'colspan' => 2]),
			Html::tag('td', $voluntaryWork->theValue('from'), ['class' => 'text-center']),
			Html::tag('td', $voluntaryWork->theValue('to'), ['class' => 'text-center']),
			Html::tag('td', $voluntaryWork->theValue('no_of_hours'), ['class' => 'text-center']),
			Html::tag('td', $voluntaryWork->theValue('position'), ['class' => 'text-center']),
		]), ['class' => 'row-height line-height-sm'])) ?>

		<?= App::for(7 - $model->totalVoluntaryWorks, fn ($i) => <<< HTML
			<tr class="row-height">
				<td colspan="2"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		HTML ) ?>
		
		<tr>
			<td colspan="6" class="text-center text-danger bg-light-gray">
				<small><em><b>(Continue on separate sheet if necessary)</b></em></small>
			</td>
		</tr>

	</tbody>
</table>