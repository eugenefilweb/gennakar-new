<?php

use app\helpers\App;
use app\helpers\Html;
?>

<table border="1">
	<tbody>
		<tr>
			<td class="border-hidden" width="9%"></td>
			<td class="border-hidden" width="9%"></td>
			<td class="border-hidden" width="25%"></td>
			<td class="border-hidden" width="10%"></td>
			<td class="border-hidden"></td>
			<td class="border-hidden" width="7.67%"></td>
			<td class="border-hidden" width="8%"></td>
			<td class="border-hidden" width="9%"></td>
			<td class="border-hidden" width="7.67%"></td>
		</tr>

		<tr>
			<td colspan="9" class=" bg-gray text-white">
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
			<td rowspan="2" class="text-center line-height-sm">
				POSITION TITLE
				<div><small>(Write in full/Do not abbreviate)</small></div>
			</td>
			<td rowspan="2" colspan="2" class="text-center line-height-sm">
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
			Html::tag('td', $workExperience->theValue('position'), ['class' => 'text-center']),
			Html::tag('td', $workExperience->theValue('company'), ['class' => 'text-center', 'colspan' => 2]),
			Html::tag('td', App::formatter()->asPeso($workExperience->salary), ['class' => 'text-center']),
			Html::tag('td', $workExperience->theValue('salary_increment'), ['class' => 'text-center']),
			Html::tag('td', $workExperience->theValue('appointment_status'), ['class' => 'text-center']),
			Html::tag('td', $workExperience->theValue('governmentServiceLabelAbb'), ['class' => 'text-center']),
		]), ['class' => 'row-height line-height-sm'])) ?>

		<?= App::for(28 - $model->totalWorkExperiences, fn ($i) =><<< HTML
			<tr class="row-height">
				<td></td>
				<td></td>
				<td></td>
				<td colspan="2"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		HTML ) ?>

		<tr>
			<td colspan="9" class="text-center text-danger bg-light-gray">
				<small><em><b>(Continue on separate sheet if necessary)</b></em></small>
			</td>
		</tr>

		<tr class="row-height">
			<td colspan="2" class="font-size-1_1rem bg-light-gray text-center">
				<em>
					<b>SIGNATURE</b>
				</em>
			</td>
			<td class="p-0 text-center" colspan="2">
				<img src="<?= $model->signature ?>"  class="signature">
			</td>
			<td class="font-size-1_1rem bg-light-gray text-center">
				<em>
					<b>DATE</b>
				</em>
			</td>
			<td colspan="4" class="text-center">
				<?= date('m/d/Y', strtotime($model->created_at)) ?>
			</td>
		</tr>

		<tr>
			<td colspan="9" class="text-right border-right-hidden border-bottom-hidden border-left-hidden pt-0 vertical-align-top line-height-sm">
				<small>
					<em>
						CS FORM 212 (Revised 2017), Page 2 of 4
					</em>
				</small>
			</td>
		</tr>
	</tbody>
</table>