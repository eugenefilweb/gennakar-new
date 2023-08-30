<?php

use app\helpers\App;
use app\helpers\Html;
?>
<tr>
	<td colspan="11" class="font-size-1_1rem bg-gray text-white">
		<em>
			<b>VII. LEARNING AND DEVELOPMENT (L&D) INTERVENTIONS/TRAINING PROGRAMS ATTENDED </b>
		</em>
	</td>
</tr>

<tr class="bg-light-gray">
	<td colspan="4" rowspan="2" class="text-center">
		<div class="d-flex align-items-baseline">
			<div class="pt-0 nowrap">30.</div>
			<div class="text-center line-height-sm">
				TITLE OF LEARNING AND DEVELOPMENT INTERVENTIONS/TRAINING PROGRAMS
				<div><small>(Write in full)</small></div>
			</div>
		</div>
	</td>

	<td colspan="2" class="text-center line-height-sm">
		<div>INCLUSIVE DATES OF ATTENDANCE </div>
		<div class="line-height-sm"><small>(mm/dd/yyyy)</small> </div>
	</td>
	<td rowspan="2" class="text-center line-height-sm"> NUMBER OF HOURS </td>
	<td rowspan="2" class="text-center line-height-sm font-size-sm"> 
		Type of LD 
		<small>( Managerial/ Supervisory/ Technical/etc) </small> 
	</td>
	<td colspan="3" rowspan="2" class="text-center"> 
		CONDUCTED/ SPONSORED BY
		<div class="line-height-sm">
			<small>(Write in full)</small>
		</div>
	</td>
</tr>
<tr class="bg-light-gray">
	<td colspan="2" class="p-0">
		<table border="1" style="">
			<tbody>
				<tr>
					<td class="text-center border-top-hidden border-left-hidden border-bottom-hidden" width="50%">From</td>
					<td class="text-center border-top-hidden border-right-hidden border-bottom-hidden">To</td>
				</tr>
			</tbody>
		</table>
	</td>
</tr>

<?= App::foreach($model->trainingPrograms, fn ($trainingProgram) => Html::tag('tr', implode('', [
	Html::tag('td', $trainingProgram->theValue('title'), ['class' => 'text-center', 'colspan' => 4]),
	Html::tag('td', <<< HTML
		<table border="1" style="height: 30px;">
			<tbody>
				<tr>
					<td class="text-center border-top-hidden border-left-hidden border-bottom-hidden" width="50%">
						{$trainingProgram->theValue('from')}
					</td>
					<td class="text-center border-top-hidden border-right-hidden border-bottom-hidden">
						{$trainingProgram->theValue('to')}
					</td>
				</tr>
			</tbody>
		</table>
	HTML, ['colspan' => '2', 'class' => 'p-0']),
	Html::tag('td', $trainingProgram->theValue('no_of_hours'), ['class' => 'text-center']),
	Html::tag('td', $trainingProgram->theValue('type'), ['class' => 'text-center']),
	Html::tag('td', $trainingProgram->theValue('conducted'), ['class' => 'text-center', 'colspan' => 3]),
]), ['class' => 'row-height line-height-sm'])) ?>