<?php

use app\helpers\App;
use app\helpers\Html;
?>

<table border="1">
	<tbody>
		<tr>
			<td class="border-hidden" ></td>
			<td class="border-hidden" width="37%"></td>
			<td class="border-hidden" width="9%"></td>
			<td class="border-hidden" width="9%"></td>
			<td class="border-hidden" width="9%"></td>
			<td class="border-hidden" width="9%"></td>
			<td class="border-hidden" width="24%"></td>
		</tr>

		<tr>
			<td colspan="7" class="font-size-1_1rem bg-gray text-white">
				<em>
					<b>VII. LEARNING AND DEVELOPMENT (L&D) INTERVENTIONS/TRAINING PROGRAMS ATTENDED </b>
				</em>
			</td>
		</tr>

		<tr class="bg-light-gray">
			<td rowspan="2" class="vertical-align-top border-right-hidden nowrap">
				30.
			</td>
			<td rowspan="2" class="text-center line-height-sm">
				TITLE OF LEARNING AND DEVELOPMENT INTERVENTIONS/TRAINING PROGRAMS 
				<div class="line-height-sm">
					<small>(Write in full)</small>
				</div>
			</td>
			<td colspan="2" class="text-center line-height-sm">
				<div>INCLUSIVE DATES OF ATTENDANCE </div>
				<div class="line-height-sm"><small>(mm/dd/yyyy)</small> </div>
			</td>
			<td rowspan="2" class="text-center line-height-sm"> NUMBER OF HOURS </td>
			<td rowspan="2" class="text-center line-height-sm"> 
				Type of LD 
				<small>( Managerial/ Supervisory/ Technical/etc) </small> 
			</td>
			<td rowspan="2" class="text-center"> 
				CONDUCTED/ SPONSORED BY
				<div class="line-height-sm">
					<small>(Write in full)</small>
				</div>
			</td>
		</tr>
		<tr class="bg-light-gray">
			<td class="text-center">From</td>
			<td class="text-center">To</td>
		</tr>


		<?= App::foreach($model->trainingPrograms, fn ($trainingProgram) => Html::tag('tr', implode('', [
			Html::tag('td', $trainingProgram->theValue('title'), ['class' => 'text-center', 'colspan' => 2]),
			Html::tag('td', $trainingProgram->theValue('from'), ['class' => 'text-center']),
			Html::tag('td', $trainingProgram->theValue('to'), ['class' => 'text-center']),
			Html::tag('td', $trainingProgram->theValue('no_of_hours'), ['class' => 'text-center']),
			Html::tag('td', $trainingProgram->theValue('type'), ['class' => 'text-center']),
			Html::tag('td', $trainingProgram->theValue('conducted'), ['class' => 'text-center']),
		]), ['class' => 'row-height line-height-sm'])) ?>

		<?= App::for(21 - $model->totalTrainingPrograms, fn ($i) => <<< HTML
			<tr class="row-height">
				<td colspan="2"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		HTML ) ?>

		<tr>
			<td colspan="7" class="text-center text-danger bg-light-gray">
				<small><em><b>(Continue on separate sheet if necessary)</b></em></small>
			</td>
		</tr>
	</tbody>
</table>