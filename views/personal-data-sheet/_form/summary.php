<?php

use app\helpers\App;
use app\helpers\ArrayHelper;
use app\helpers\Html;
use app\helpers\Url;
use app\models\PersonalDataSheet;
use app\widgets\ActiveForm;

$formSteps = ArrayHelper::index(PersonalDataSheet::STEP_FORM, 'slug');
$questionnaire = PersonalDataSheet::QUESTIONNAIRE;

$this->registerCss(<<< CSS
	th, td {
		padding: 0.4rem;
	}
	th {
		background: #e7e7e7;
	}
CSS);
?>

<?php $form = ActiveForm::begin(['id' => 'pds-form']); ?>
    <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

	<section>
		<h6 class="font-weight-bolder mb-3">
			<?= $formSteps['personal-information']['title'] ?>
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', [$action, 'token' => $model->token, 'step' => 'personal-information']) ?>
		</h6>

		<div class="text-dark-50 line-height-lg">
			<div> 
				<b><?= $model->getAttributeLabel('fullname') ?>:</b> 
				<?= $model->theValue('fullname') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('sexLabel') ?>:</b> 
				<?= $model->theValue('sexLabel') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('civil_status') ?>:</b> 
				<?= $model->theValue('civil_status') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('date_of_birth') ?>:</b> 
				<?= $model->theValue('date_of_birth') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('place_of_birth') ?>:</b> 
				<?= $model->theValue('place_of_birth') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('height') ?>:</b> 
				<?= $model->theValue('height') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('weight') ?>:</b> 
				<?= $model->theValue('weight') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('blood_type') ?>:</b> 
				<?= $model->theValue('blood_type') ?> 
			</div>
		</div>

		<h6 class="font-weight-bolder my-3 mt-5"> 
			Government ID's 
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', Url::toRoute([$action, 'token' => $model->token, 'step' => 'personal-information']) . '#government-id') ?>
		</h6>
		<div class="text-dark-50 line-height-lg">
			<div> 
				<b><?= $model->getAttributeLabel('gsis_id_no') ?>:</b> 
				<?= $model->theValue('gsis_id_no') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('pagibig_id_no') ?>:</b> 
				<?= $model->theValue('pagibig_id_no') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('philhealth_no') ?>:</b> 
				<?= $model->theValue('philhealth_no') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('sss_no') ?>:</b> 
				<?= $model->theValue('sss_no') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('tin_no') ?>:</b> 
				<?= $model->theValue('tin_no') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('agency_employee_no') ?>:</b> 
				<?= $model->theValue('agency_employee_no') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('government_issued_id') ?>:</b> 
				<?= $model->theValue('government_issued_id') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('government_id_no') ?>:</b> 
				<?= $model->theValue('government_id_no') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('government_id_place_of_issuance') ?>:</b> 
				<?= $model->theValue('government_id_place_of_issuance') ?> 
			</div>
		</div>

		<h6 class="font-weight-bolder my-3 mt-5"> 
			Citizenship 
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', Url::toRoute([$action, 'token' => $model->token, 'step' => 'personal-information']) . '#citizenship') ?>
		</h6>
		<div class="text-dark-50 line-height-lg">
			<div> 
				<b><?= $model->getAttributeLabel('citizenshipLabel') ?>:</b> 
				<?= $model->theValue('citizenshipLabel') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('citizenshipTypeLabel') ?>:</b> 
				<?= $model->theValue('citizenshipTypeLabel') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('dual_citizenship_country') ?>:</b> 
				<?= $model->theValue('dual_citizenship_country') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('dual_citizenship_details') ?>:</b> 
				<?= $model->theValue('dual_citizenship_details') ?> 
			</div>
		</div>


		<h6 class="font-weight-bolder my-3 mt-5"> 
			Residential Address 
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', Url::toRoute([$action, 'token' => $model->token, 'step' => 'personal-information']) . '#residential-address') ?>
		</h6>
		<div class="text-dark-50 line-height-lg">
			<div> 
				<b><?= $model->getAttributeLabel('ra_house_block_lot_no') ?>:</b> 
				<?= $model->theValue('ra_house_block_lot_no') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('ra_street') ?>:</b> 
				<?= $model->theValue('ra_street') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('ra_subdivision_village') ?>:</b> 
				<?= $model->theValue('ra_subdivision_village') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('ra_barangay') ?>:</b> 
				<?= $model->theValue('ra_barangay') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('ra_city_municipality') ?>:</b> 
				<?= $model->theValue('ra_city_municipality') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('ra_province') ?>:</b> 
				<?= $model->theValue('ra_province') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('ra_zip_code') ?>:</b> 
				<?= $model->theValue('ra_zip_code') ?> 
			</div>
		</div>

		<h6 class="font-weight-bolder my-3 mt-5"> 
			Permanent  Address 
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', Url::toRoute([$action, 'token' => $model->token, 'step' => 'personal-information']) . '#permanent-address') ?>
		</h6>
		<div class="text-dark-50 line-height-lg">
			<div> 
				<b><?= $model->getAttributeLabel('pa_house_block_lot_no') ?>:</b> 
				<?= $model->theValue('pa_house_block_lot_no') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('pa_street') ?>:</b> 
				<?= $model->theValue('pa_street') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('pa_subdivision_village') ?>:</b> 
				<?= $model->theValue('pa_subdivision_village') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('pa_barangay') ?>:</b> 
				<?= $model->theValue('pa_barangay') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('pa_city_municipality') ?>:</b> 
				<?= $model->theValue('pa_city_municipality') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('pa_province') ?>:</b> 
				<?= $model->theValue('pa_province') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('pa_zip_code') ?>:</b> 
				<?= $model->theValue('pa_zip_code') ?> 
			</div>
		</div>
		<h6 class="font-weight-bolder my-3 mt-5"> 
			Contact Details 
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', Url::toRoute([$action, 'token' => $model->token, 'step' => 'personal-information']) . '#contact-details') ?>
		</h6>
		<div class="text-dark-50 line-height-lg">
			<div> 
				<b><?= $model->getAttributeLabel('telephone_no') ?>:</b> 
				<?= $model->theValue('telephone_no') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('mobile_no') ?>:</b> 
				<?= $model->theValue('mobile_no') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('email_address') ?>:</b> 
				<?= $model->theValue('email_address') ?> 
			</div>
		</div>

		<h6 class="font-weight-bolder my-3 mt-5"> 
			Photo 
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', Url::toRoute([$action, 'token' => $model->token, 'step' => 'personal-information']) . '#photo') ?>
		</h6>
		<div class="text-dark-50 line-height-lg">
			<?= Html::image($model->photo, ['w' => 200], ['class' => 'img-fluid img-thumbnail']) ?>
		</div>

		<h6 class="font-weight-bolder my-3 mt-5"> 
			Right Thumbmark 
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', Url::toRoute([$action, 'token' => $model->token, 'step' => 'personal-information']) . '#right-thumbmark') ?>
		</h6>
		<div class="text-dark-50 line-height-lg">
			<?= Html::image($model->right_thumbmark, ['w' => 200], ['class' => 'img-fluid img-thumbnail']) ?>
		</div>

		<h6 class="font-weight-bolder my-3 mt-5"> 
			E-Signature
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', Url::toRoute([$action, 'token' => $model->token, 'step' => 'personal-information']) . '#e-signature') ?>
		</h6>
		<div class="text-dark-50 line-height-lg">
			<?= Html::img($model->signature, ['class' => 'img-fluid img-thumbnail']) ?>
		</div>
	</section>

	<div class="separator separator-dashed my-5"></div>

	<section>
		<h6 class="font-weight-bolder mb-3">
			<?= $formSteps['family-background']['title'] ?>
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', Url::toRoute([$action, 'token' => $model->token, 'step' => 'family-background'])) ?>
		</h6>

		<h6 class="font-weight-bolder my-3 mt-5"> Spouse </h6>
		<div class="text-dark-50 line-height-lg">
			<div> 
				<b><?= $model->getAttributeLabel('spouseFullname') ?>:</b> 
				<?= $model->theValue('spouseFullname') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('spouse_occupation') ?>:</b> 
				<?= $model->theValue('spouse_occupation') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('spouse_employer') ?>:</b> 
				<?= $model->theValue('spouse_employer') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('spouse_employer_address') ?>:</b> 
				<?= $model->theValue('spouse_employer_address') ?> 
			</div>
			<div> 
				<b><?= $model->getAttributeLabel('spouse_employer_telephone_no') ?>:</b> 
				<?= $model->theValue('spouse_employer_telephone_no') ?> 
			</div>
		</div>

		<h6 class="font-weight-bolder my-3 mt-5"> 
			Children 
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', Url::toRoute([$action, 'token' => $model->token, 'step' => 'family-background']) . '#children') ?>
		</h6>
		<div class="text-dark-50 line-height-lg">
			<table style="width:100%" border="1">
				<thead>
					<tr>
						<th>#</th>
						<th>name</th>
						<th>birthdate</th>
					</tr>
				</thead>
				<tbody>
					<?= App::foreach($model->childrens, fn ($children, $key, $counter) => Html::tag('tr', implode('', [
						Html::tag('td', $counter),
						Html::tag('td', strtoupper($children['name'])),
						Html::tag('td', date('m/d/Y', strtotime($children['birthdate']))),
					]))) ?>
				</tbody>
			</table>
		</div>

		<h6 class="font-weight-bolder my-3 mt-5"> 
			Father 
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', Url::toRoute([$action, 'token' => $model->token, 'step' => 'family-background']) . '#father') ?>
		</h6>
		<div class="text-dark-50 line-height-lg">
			<div> 
				<b><?= $model->getAttributeLabel('fatherFullname') ?>:</b> 
				<?= $model->theValue('fatherFullname') ?> 
			</div>
		</div>

		<h6 class="font-weight-bolder my-3 mt-5"> 
			Mother 
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', Url::toRoute([$action, 'token' => $model->token, 'step' => 'family-background']) . '#mother') ?>
		</h6>
		<div class="text-dark-50 line-height-lg">
			<div> 
				<b><?= $model->getAttributeLabel('motherFullname') ?>:</b> 
				<?= $model->theValue('motherFullname') ?> 
			</div>
		</div>
	</section>

	<div class="separator separator-dashed my-5"></div>
	<section>
		<h6 class="font-weight-bolder mb-3">
			<?= $formSteps['educational-background']['title'] ?>
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', [$action, 'token' => $model->token, 'step' => 'educational-background']) ?>
		</h6>

		<div class="text-dark-50 line-height-lg">
			<table style="width:100%" border="1">
				<thead>
					<tr>
						<th>#</th>
		                <th>school</th>
		                <th>period of attendance</th>
		                <th>graduate</th>
					</tr>
				</thead>
				<tbody>
					<?= App::foreach($model->educations, fn ($education, $key, $counter) => Html::tag('tr', implode('', [
						Html::tag('td', $counter),
						Html::tag('td', implode('', [
							Html::tag('div', $education->theValue('name')),
							Html::tag('div', 'Level: ' . $education->theValue('level')),
							Html::tag('div', 'Course: ' . $education->theValue('course')),
						])),
						Html::tag('td', implode('', [
							Html::tag('div', 'From: ' . $education->theValue('from')),
							Html::tag('div', 'To: ' . $education->theValue('to')),
						])),
						Html::tag('td', implode('', [
							Html::tag('div', 'Year: ' . $education->theValue('year_graduated')),
							Html::tag('div', 'Units: ' . $education->theValue('highest_level')),
							Html::tag('div', 'Honor: ' . $education->theValue('academic_honor')),
						])),
					]))) ?>
				</tbody>
			</table>
		</div>
	</section>

	<div class="separator separator-dashed my-5"></div>
	<section>
		<h6 class="font-weight-bolder mb-3">
			<?= $formSteps['civil-service']['title'] ?>
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', [$action, 'token' => $model->token, 'step' => 'civil-service']) ?>
		</h6>

		<div class="text-dark-50 line-height-lg">
			<table style="width:100%" border="1">
				<thead>
					<tr>
						<th>#</th>
		                <th>civil service</th>
		                <th>date</th>
		                <th>place</th>
		                <th>license</th>
					</tr>
				</thead>
				<tbody>
					<?= App::foreach($model->civilServices, fn ($civilService, $key, $counter) => Html::tag('tr', implode('', [
						Html::tag('td', $counter),
						Html::tag('td', implode('', [
							Html::tag('div', $civilService->theValue('career_service')),
							Html::tag('div', 'Rating: ' . $civilService->theValue('rating')),
						])),
						Html::tag('td', $civilService->theValue('date_of_examination')),
						Html::tag('td', $civilService->theValue('place_of_examination')),
						Html::tag('td', implode('', [
							Html::tag('div', 'Number: ' . $civilService->theValue('license')),
							Html::tag('div', 'Validity: ' . $civilService->theValue('license_date')),
						])),
					]))) ?>
				</tbody>
			</table>
		</div>
	</section>


	<div class="separator separator-dashed my-5"></div>
	<section>
		<h6 class="font-weight-bolder mb-3">
			<?= $formSteps['work-experience']['title'] ?>
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', [$action, 'token' => $model->token, 'step' => 'work-experience']) ?>
		</h6>

		<div class="text-dark-50 line-height-lg">
			<table style="width:100%" border="1">
				<thead>
					<tr>
						<th>#</th>
		                <th>company</th>
		                <th>date</th>
		                <th>salary</th>
		                <th>status</th>
					</tr>
				</thead>
				<tbody>
					<?= App::foreach($model->workExperiences, fn ($workExperience, $key, $counter) => Html::tag('tr', implode('', [
						Html::tag('td', $counter),
						Html::tag('td', implode('', [
							Html::tag('div', $workExperience->theValue('company')),
							Html::tag('div', 'Position: ' . $workExperience->theValue('position')),
							Html::tag('div', 'Government: ' . $workExperience->theValue('governmentServiceLabel')),
						])),
						Html::tag('td', implode('', [
							Html::tag('div', 'From: ' . $workExperience->theValue('from')),
							Html::tag('div', 'To: ' . $workExperience->theValue('to')),
						])),

						Html::tag('td', implode('', [
							Html::tag('div', App::formatter()->asPeso($workExperience->theValue('salary'))),
							Html::tag('div', 'Pay Grade: ' . $workExperience->theValue('salary_increment')),
						])),
						Html::tag('td', $workExperience->theValue('appointment_status')),
					]))) ?>
				</tbody>
			</table>
		</div>
	</section>

	<div class="separator separator-dashed my-5"></div>
	<section>
		<h6 class="font-weight-bolder mb-3">
			<?= $formSteps['organization']['title'] ?>
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', [$action, 'token' => $model->token, 'step' => 'organization']) ?>
		</h6>
		<div class="text-dark-50 line-height-lg">
			<table style="width:100%" border="1">
				<thead>
					<tr>
						<th>#</th>
		                <th>name</th>
		                <th>date</th>
		                <th>no of hours</th>
		                <th>position</th>
					</tr>
				</thead>
				<tbody>
					<?= App::foreach($model->voluntaryWorks, fn ($voluntaryWork, $key, $counter) => Html::tag('tr', implode('', [
						Html::tag('td', $counter),
						Html::tag('td', implode('', [
							Html::tag('div', $voluntaryWork->theValue('name')),
							Html::tag('div', 'Address: ' . $voluntaryWork->theValue('address')),
						])),
						Html::tag('td', implode('', [
							Html::tag('div', 'From: ' . $voluntaryWork->theValue('from')),
							Html::tag('div', 'To: ' . $voluntaryWork->theValue('to')),
						])),
						Html::tag('td', $voluntaryWork->theValue('no_of_hours')),
						Html::tag('td', $voluntaryWork->theValue('position')),
					]))) ?>
				</tbody>
			</table>
		</div>
	</section>

	<div class="separator separator-dashed my-5"></div>
	<section>
		<h6 class="font-weight-bolder mb-3">
			<?= $formSteps['training-program']['title'] ?>
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', [$action, 'token' => $model->token, 'step' => 'training-program']) ?>
		</h6>
		<div class="text-dark-50 line-height-lg">
			<table style="width:100%" border="1">
				<thead>
					<tr>
						<th>#</th>
		                <th>title</th>
		                <th>date</th>
		                <th>hours</th>
		                <th>conducted</th>
					</tr>
				</thead>
				<tbody>
					<?= App::foreach($model->trainingPrograms, fn ($trainingProgram, $key, $counter) => Html::tag('tr', implode('', [
						Html::tag('td', $counter),
						Html::tag('td', implode('', [
							Html::tag('div', $trainingProgram->theValue('title')),
							Html::tag('div', 'Type: ' . $trainingProgram->theValue('type')),
						])),
						Html::tag('td', implode('', [
							Html::tag('div', 'From: ' . $trainingProgram->theValue('from')),
							Html::tag('div', 'To: ' . $trainingProgram->theValue('to')),
						])),
						Html::tag('td', $trainingProgram->theValue('no_of_hours')),
						Html::tag('td', $trainingProgram->theValue('conducted')),
					]))) ?>
				</tbody>
			</table>
		</div>
	</section>

	<div class="separator separator-dashed my-5"></div>
	<section>
		<h6 class="font-weight-bolder mb-3">
			<?= $formSteps['other']['title'] ?>
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', [$action, 'token' => $model->token, 'step' => 'other']) ?>
		</h6>
		<h6 class="font-weight-bolder my-3 mt-5"> Special Skills & Hobbies </h6>
		<div class="text-dark-50 line-height-lg">
			<?= Html::ul($model->skills) ?>
		</div>

		<h6 class="font-weight-bolder my-3 mt-5"> Recognitions </h6>
		<div class="text-dark-50 line-height-lg">
			<?= Html::ul($model->recognitions) ?>
		</div>

		<h6 class="font-weight-bolder my-3 mt-5"> Organizations </h6>
		<div class="text-dark-50 line-height-lg">
			<?= Html::ul($model->organizations) ?>
		</div>
	</section>


	<div class="separator separator-dashed my-5"></div>
	<section>
		<h6 class="font-weight-bolder mb-3">
			<?= $formSteps['questionnaire']['title'] ?>
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', [$action, 'token' => $model->token, 'step' => 'questionnaire']) ?>
		</h6>
		<div class="text-dark-50 line-height-lg">
			<table style="width:100%" border="1">
				<tbody>
					<tr>
						<th colspan="2">Consanguinity Related</th>
					</tr>
					<tr>
						<?= Html::tag('td', $questionnaire['consanguinity_related'][0], ['colspan' => 2]) ?>
					</tr>
					<tr>
						<?= Html::tag('td', $questionnaire['consanguinity_related'][1]) ?>
						<td><?= $model->consanguinity_related['answer']['a'] ?? 'no' ?></td>
					</tr>
					<tr>
						<?= Html::tag('td', $questionnaire['consanguinity_related'][2]) ?>
						<td><?= $model->consanguinity_related['answer']['b'] ?? 'no' ?></td>
					</tr>
					<tr>
						<td>If Yes, details</td>
						<td><?= $model->consanguinity_related['yes_details'] ?? '' ?></td>
					</tr>

					<tr>
						<th colspan="2">Administrative Offense</th>
					</tr>
					<tr>
						<?= Html::tag('td', $questionnaire['administrative_offense']) ?>
						<td><?= $model->administrative_offense['answer'] ?? 'no' ?></td>
					</tr>
					<tr>
						<td>If Yes, details</td>
						<td><?= $model->administrative_offense['yes_details'] ?? '' ?></td>
					</tr>

					<tr>
						<th colspan="2">Charged Criminally</th>
					</tr>
					<tr>
						<?= Html::tag('td', $questionnaire['charged_criminally']) ?>
						<td><?= $model->charged_criminally['answer'] ?? 'no' ?></td>
					</tr>
					<tr>
						<td rowspan="2">If Yes, details</td>
						<td>Date Filed: <?= date('m/d/Y', strtotime($model->charged_criminally['date_filed'] ?? time())) ?></td>
					</tr>
					<tr>
						<td>Status: <?= $model->charged_criminally['status'] ?? '' ?></td>
					</tr>


					<tr>
						<th colspan="2">Crime Convicted</th>
					</tr>
					<tr>
						<?= Html::tag('td', $questionnaire['crime_convicted']) ?>
						<td><?= $model->crime_convicted['answer'] ?? 'no' ?></td>
					</tr>
					<tr>
						<td>If Yes, details</td>
						<td><?= $model->crime_convicted['yes_details'] ?? '' ?></td>
					</tr>


					<tr>
						<th colspan="2">Service Separated</th>
					</tr>
					<tr>
						<?= Html::tag('td', $questionnaire['service_separated']) ?>
						<td><?= $model->service_separated['answer'] ?? 'no' ?></td>
					</tr>
					<tr>
						<td>If Yes, details</td>
						<td><?= $model->service_separated['yes_details'] ?? '' ?></td>
					</tr>

					<tr>
						<th colspan="2">Election Candidate</th>
					</tr>
					<tr>
						<?= Html::tag('td', $questionnaire['election_candidate']) ?>
						<td><?= $model->election_candidate['answer'] ?? 'no' ?></td>
					</tr>
					<tr>
						<td>If Yes, details</td>
						<td><?= $model->election_candidate['yes_details'] ?? '' ?></td>
					</tr>

					<tr>
						<th colspan="2">Government Resigned</th>
					</tr>
					<tr>
						<?= Html::tag('td', $questionnaire['government_resigned']) ?>
						<td><?= $model->government_resigned['answer'] ?? 'no' ?></td>
					</tr>
					<tr>
						<td>If Yes, details</td>
						<td><?= $model->government_resigned['yes_details'] ?? '' ?></td>
					</tr>



					<tr>
						<th colspan="2">Other Country Resident</th>
					</tr>
					<tr>
						<?= Html::tag('td', $questionnaire['other_country_resident']) ?>
						<td><?= $model->other_country_resident['answer'] ?? 'no' ?></td>
					</tr>
					<tr>
						<td>If Yes, details</td>
						<td><?= $model->other_country_resident['yes_details'] ?? '' ?></td>
					</tr>

					<tr>
						<th colspan="2">Other Information</th>
					</tr>
					<tr>
						<?= Html::tag('td', $questionnaire['other_information'], ['colspan' => 2]) ?>
					</tr>

					<tr>
						<?= Html::tag('th', 'indigenous group', ['colspan' => 2]) ?>
					</tr>
					<tr>
						<?= Html::tag('td', $questionnaire['indigenous_group']) ?>
						<td><?= $model->indigenous_group['answer'] ?? 'no' ?></td>
					</tr>
					<tr>
						<td>If Yes, please specify:</td>
						<td><?= $model->indigenous_group['name'] ?? '' ?></td>
					</tr>

					<tr>
						<?= Html::tag('th', 'pwd', ['colspan' => 2]) ?>
					</tr>
					<tr>
						<?= Html::tag('td', $questionnaire['pwd']) ?>
						<td><?= $model->pwd['answer'] ?? 'no' ?></td>
					</tr>
					<tr>
						<td>If Yes, please specify ID No:</td>
						<td><?= $model->pwd['id_no'] ?? '' ?></td>
					</tr>

					<tr>
						<?= Html::tag('th', 'solo parent', ['colspan' => 2]) ?>
					</tr>
					<tr>
						<?= Html::tag('td', $questionnaire['solo_parent']) ?>
						<td><?= $model->solo_parent['answer'] ?? 'no' ?></td>
					</tr>
					<tr>
						<td>If Yes, please specify ID No:</td>
						<td><?= $model->solo_parent['id_no'] ?? '' ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</section>

	<div class="separator separator-dashed my-5"></div>
	<section>
		<h6 class="font-weight-bolder mb-3">
			<?= $formSteps['reference']['title'] ?>
			<?= Html::a('<i class="fa fa-edit text-warning" title="Edit" data-toggle="tooltip"></i>', [$action, 'token' => $model->token, 'step' => 'reference']) ?>
		</h6>
		<div class="text-dark-50 line-height-lg">
			<table style="width:100%" border="1">
				<thead>
					<tr>
						<th>#</th>
						<th>name</th>
						<th>address</th>
						<th>tel no</th>
					</tr>
				</thead>
				<tbody>
					<?= App::foreach($model->references, fn ($reference, $index, $counter) => Html::tag('tr', implode('', [
						Html::tag('td', $counter),
						Html::tag('td', $reference['name'] ?? ''),
						Html::tag('td', $reference['address'] ?? ''),
						Html::tag('td', $reference['tel_no'] ?? ''),
					]))) ?>
				</tbody>
			</table>
		</div>
	</section>

    <div class="form-group mt-5">
        <?= Html::a('Back', Url::current(['step' => 'questionnaire']), [
            'class' => 'btn btn-secondary btn-lg'
        ]) ?>

        <?= Html::submitButton('Submit', [
            'class' => 'btn btn-success btn-lg'
        ]) ?>
    </div>
<?php ActiveForm::end(); ?>