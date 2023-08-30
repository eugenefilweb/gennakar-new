<?php

use app\models\PersonalDataSheet;

$questionnaire = PersonalDataSheet::QUESTIONNAIRE;
?>
<table border="1">
	<tbody>

		<tr>
			<td width="3%" class="text-center vertical-align-top border-right-hidden border-bottom-hidden bg-light-gray">34.</td>
			<td width="60%" class="border-bottom-hidden bg-light-gray">
				<?= $questionnaire['consanguinity_related'][0] ?>
			</td>
			<td class="border-bottom-hidden"></td>
		</tr>

		<tr>
			<td class="border-right-hidden border-bottom-hidden bg-light-gray"></td>
			<td class="border-bottom-hidden bg-light-gray">
				<?= $questionnaire['consanguinity_related'][1] ?>
			</td>
			<td class="border-bottom-hidden pt-1">
				<?= $this->render('_questionnaire-yes-no', [
					'value' => $model->consanguinity_related['answer']['a'] ?? 'no'
				]) ?>
			</td>
		</tr>

		<tr>
			<td class="border-right-hidden bg-light-gray"></td>
			<td class="bg-light-gray vertical-align-top">
				<?= $questionnaire['consanguinity_related'][2] ?>
			</td>
			<td class="pt-1">
				<?= $this->render('_questionnaire-yes-no', [
					'value' => $model->consanguinity_related['answer']['b'] ?? 'no'
				]) ?>

				<div class="ml-3"> 
					If YES, give details: 
					<div>
						<?= $model->consanguinity_related['yes_details'] ?? '' ?>
					</div>
				</div>
			</td>
		</tr>

		<!-- ============================================================================ -->
		<tr>
			<td width="3%" class="text-center vertical-align-top border-right-hidden border-bottom-hidden bg-light-gray">35.</td>
			<td width="65%" class="border-bottom-hidden bg-light-gray vertical-align-top">
				a. <?= $questionnaire['administrative_offense'] ?>
			</td>
			<td class="pt-1">
				<?= $this->render('_questionnaire-yes-no', [
					'value' => $model->administrative_offense['answer'] ?? 'no'
				]) ?>
				<div class="ml-3">
					If YES, give details:
					<div>
						<?= $model->administrative_offense['yes_details'] ?? '' ?>
					</div>
				</div>
			</td>
		</tr>
		 
		<tr>
			<td class="border-right-hidden bg-light-gray"></td>
			<td class="bg-light-gray vertical-align-top">
				b. <?= $questionnaire['charged_criminally'] ?>
			</td>

			<td class="pt-1">
				<?= $this->render('_questionnaire-yes-no', [
					'value' => $model->charged_criminally['answer'] ?? 'no'
				]) ?>
				<div class="ml-3"> 
					If YES, give details:
					<div class="ml-13"> Date Filed:  
						<span class="text-underline ml-1">
							<?= date('m/d/Y', strtotime($model->charged_criminally['date_filed'] ?? time())) ?>
						</span>
					</div>

					<div>
						Status of Case/s: 
						<span class="text-underline ml-1">
							<?= $model->charged_criminally['status'] ?? '' ?>
						</span>
					</div>
				</div>
			</td>
		</tr>

		<!-- ============================================================================ -->
		<tr>
			<td width="3%" class="text-center vertical-align-top border-right-hidden bg-light-gray">36.</td>
			<td width="65%" class="bg-light-gray vertical-align-top">
				<?= $questionnaire['crime_convicted'] ?>
			</td>
			<td class="pt-1">
				<?= $this->render('_questionnaire-yes-no', [
					'value' => $model->crime_convicted['answer'] ?? 'no'
				]) ?>
				<div class="ml-3"> 
					If YES, give details:
					<div>
						<?= $model->crime_convicted['yes_details'] ?? '' ?>
					</div>
				</div>
			</td>
		</tr>

		<!-- ============================================================================ -->
		<tr>
			<td width="3%" class="text-center vertical-align-top border-right-hidden bg-light-gray">37.</td>
			<td width="65%" class="bg-light-gray vertical-align-top">
				<?= $questionnaire['service_separated'] ?>
			</td>
			<td class="pt-1">
				<?= $this->render('_questionnaire-yes-no', [
					'value' => $model->service_separated['answer'] ?? 'no'
				]) ?>
				<div class="ml-3"> 
					If YES, give details:
					<div>
						<?= $model->service_separated['yes_details'] ?? '' ?>
					</div>
				</div>
			</td>
		</tr>

		<!-- ============================================================================ -->
		<tr>
			<td width="3%" class="text-center vertical-align-top border-right-hidden bg-light-gray border-bottom-hidden">38.</td>
			<td width="65%" class="bg-light-gray vertical-align-top border-bottom-hidden">
				<p>
					a. <?= $questionnaire['election_candidate'] ?>
				</p>
			</td>
			<td class="border-bottom-hidden pt-1">
				<?= $this->render('_questionnaire-yes-no', [
					'value' => $model->election_candidate['answer'] ?? 'no'
				]) ?>
				<div class="ml-3"> 
					If YES, give details:
					<span class="text-underline">
						<?= $model->election_candidate['yes_details'] ?? '' ?>
					</span>
				</div>
			</td>
		</tr>


		<tr>
			<td class="border-right-hidden bg-light-gray"></td>
			<td class="bg-light-gray vertical-align-top">
				b. <?= $questionnaire['government_resigned'] ?>
			</td>

			<td class="pt-1">
				<?= $this->render('_questionnaire-yes-no', [
					'value' => $model->government_resigned['answer'] ?? 'no'
				]) ?>
				<div class="ml-3"> 
					If YES, give details:
					<span class="text-underline">
						<?= $model->government_resigned['yes_details'] ?? '' ?>
					</span>
				</div>
			</td>
		</tr>

		<!-- ============================================================================ -->
		<tr>
			<td width="3%" class="text-center vertical-align-top border-right-hidden bg-light-gray">39.</td>
			<td width="65%" class="bg-light-gray vertical-align-top">
				<?= $questionnaire['other_country_resident'] ?>
			</td>
			<td class="pt-1">
				<?= $this->render('_questionnaire-yes-no', [
					'value' => $model->other_country_resident['answer'] ?? 'no'
				]) ?>
				<div class="ml-3"> 
					If YES, give details (country):
					<div>
						<?= $model->other_country_resident['yes_details'] ?? '' ?>
					</div>
				</div>
			</td>
		</tr>

		<!-- ============================================================================ -->
		<tr>
			<td width="3%" class="text-center vertical-align-top border-right-hidden bg-light-gray border-bottom-hidden">40.</td>
			<td width="65%" class="bg-light-gray vertical-align-top border-bottom-hidden">
				<p><?= $questionnaire['other_information'] ?></p>
			</td>
			<td class="border-bottom-hidden"></td>
		</tr>

		<tr>
			<td class="vertical-align-top bg-light-gray border-right-hidden border-bottom-hidden">a.</td>
			<td class="vertical-align-top bg-light-gray border-bottom-hidden">
				<?= $questionnaire['indigenous_group'] ?>
			</td>
			<td class="pt-1 border-bottom-hidden">
				<?= $this->render('_questionnaire-yes-no', [
					'value' => $model->indigenous_group['answer'] ?? 'no'
				]) ?>
				<div class="ml-3"> 
					<p class="line-height-md">
						If YES, please specify:
						<span class="text-underline">
							<?= $model->indigenous_group['name'] ?? '' ?>
						</span>
					</p>
				</div>
			</td>
		</tr>

		<tr>
			<td class="vertical-align-top bg-light-gray border-right-hidden border-bottom-hidden">b.</td>
			<td class="vertical-align-top bg-light-gray border-bottom-hidden">
				<?= $questionnaire['pwd'] ?>
			</td>
			<td class="pt-1 border-bottom-hidden">
				<?= $this->render('_questionnaire-yes-no', [
					'value' => $model->pwd['answer'] ?? 'no'
				]) ?>
				<div class="ml-3"> 
					<p class="line-height-md">
						If YES, please specify ID No: 
						<span class="text-underline">
							<?= $model->pwd['id_no'] ?? '' ?>
						</span>
					</p>
				</div>
			</td>
		</tr>

		<tr>
			<td class="vertical-align-top bg-light-gray border-right-hidden">c.</td>
			<td class="vertical-align-top bg-light-gray">
				<?= $questionnaire['solo_parent'] ?>
			</td>
			<td class="pt-1">
				<?= $this->render('_questionnaire-yes-no', [
					'value' => $model->solo_parent['answer'] ?? 'no'
				]) ?>
				<div class="ml-3"> 
					<p class="line-height-md">
						If YES, please specify ID No: 
						<span class="text-underline">
							<?= $model->solo_parent['id_no'] ?? '' ?>
						</span>
					</p>
				</div>
			</td>
		</tr>
	</tbody>
</table>