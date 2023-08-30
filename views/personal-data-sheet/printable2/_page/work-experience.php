<?php

use app\helpers\App;
use app\helpers\Html;
?>

<tr>
	<td colspan="11" class=" bg-gray text-white">
		<em>
			<b class="font-size-1_1rem">V. WORK EXPERIENCE </b>
			<div>(Include private employment. Start from your recent work) Description of duties should be indicated in the attached Work Experience sheet.</div>
		</em>
	</td>
</tr>

<tr class="bg-light-gray">
	<td colspan="2" class="text-center">
		<div class="d-flex align-items-baseline">
			<div class="pt-0">28.</div>
			<div class="text-center line-height-sm ml-7">
				INCLUSIVE DATES
				<div><small>(mm/dd/yyyy)</small></div>
			</div>
		</div>
	</td>
	<td rowspan="2" colspan="2" class="text-center line-height-sm">
		POSITION TITLE
		<div><small>(Write in full/Do not abbreviate)</small></div>
	</td>
	<td rowspan="2" colspan="3" colspan="2" class="text-center line-height-sm">
		DEPARTMENT / AGENCY / OFFICE / COMPANY
		<div><small>(Write in full/Do not abbreviate)</small></div>
	</td>
	<td rowspan="2" class="text-center line-height-sm">
		MONTHLY SALARY
	</td>
	<td rowspan="2" class="text-center line-height-sm">
		SALARY/ JOB/ PAY GRADE
		<small>(if applicable)& STEP (Format "00-0")</small>
		/INCREMENT
	</td>
	<td rowspan="2" class="text-center line-height-sm">
		STATUS OF APPOINTMENT
	</td>
	
	<td rowspan="2" class="text-center line-height-sm">
		GOV'T SERVICE
		<div><small>(Y/ N)</small></div>
	</td>
</tr>

<tr class="bg-light-gray">
	<td class="text-center">From</td>
	<td class="text-center">To</td>
</tr>

<?= App::foreach($model->workExperiences, fn ($workExperience) => Html::tag('tr', implode('', [
	Html::tag('td', $workExperience->theValue('from'), ['class' => 'text-center']),
	Html::tag('td', $workExperience->theValue('to'), ['class' => 'text-center']),
	Html::tag('td', $workExperience->theValue('position'), ['class' => 'text-center', 'colspan' => 2]),
	Html::tag('td', $workExperience->theValue('company'), ['class' => 'text-center', 'colspan' => 3]),
	Html::tag('td', App::formatter()->asPeso($workExperience->salary), ['class' => 'text-center']),
	Html::tag('td', $workExperience->theValue('salary_increment'), ['class' => 'text-center']),
	Html::tag('td', $workExperience->theValue('appointment_status'), ['class' => 'text-center']),
	Html::tag('td', $workExperience->theValue('governmentServiceLabelAbb'), ['class' => 'text-center']),
]), ['class' => 'row-height line-height-sm'])) ?>

