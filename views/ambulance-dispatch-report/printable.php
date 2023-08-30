<?php

use app\helpers\App;
use app\helpers\Html;

$this->registerCss(<<< CSS
	#printable {
		font-size: 12pt;
		max-width: 1024px;
	}
	
	#printable table {
		width: 100%;
	}
	#printable td {
		padding-top: 0.8rem !important;
		padding-bottom: 0.8rem !important;
	}
CSS);

$this->params['withHeader'] = false;
?>

<div id="printable" style="<?= $style ?? '' ?>">
	<table>
		<thead>
			<tr>
				<td class="text-center" width="20%">
					<?= Html::image(App::setting('image')->primary_logo, ['w' => 100], ['class' => 'img-fluid']) ?>
				</td>
				<td class="text-center" colspan="3">
					<p class="mb-0 font-weight-bolder">Republic of the Philippines</p>
					<h5 class="mb-0 font-weight-bolder">MUNICIPALITY OF GENERAL NAKAR</h5>
					<p class="mb-0 font-weight-bolder">Province of Quezon</p>
				</td>
				<td class="text-center" width="20%">
					<?= Html::image(App::setting('image')->responders_logo, ['w' => 100], ['class' => 'img-fluid']) ?>
				</td>
			</tr>
			<tr style="border-top: 1px solid;">
				<td colspan="5">
					<h2 class="text-center font-weight-bolder mt-5 mb-15">MUNICIPAL DISASTER RISK REDUCTION AND MANAGEMENT OFFICE</h2>
				</td>
			</tr>
		</thead>

		<tbody>
			<tr>
				<td colspan="5" class="text-center">
					<h2 class="font-weight-bolder">Ambulance Dispatch Report</h2>
				</td>
			</tr>
			<tr>
				<td colspan="2">Date/Time of Request: <?= $model->theValue('date_time') ?></td>
				<td>Report ID: <?= $model->theValue('reportId') ?></td>
			</tr>


			<!-- Requesting Party Information -->
			<tr> <td colspan="5"><div class="my-10"></div></td> </tr>
			<tr>
				<td colspan="5" class="font-weight-bolder"> Requesting Party Information </td>
			</tr>
			<tr>
				<td colspan="5">Name: <?= $model->theValue('requester_name') ?></td>
			</tr>
			<tr>
				<td colspan="5">Contact Information: <?= $model->theValue('requester_contact') ?></td>
			</tr>
			<tr>
				<td colspan="5">Relationship to Patient: <?= $model->theValue('requester_relation') ?></td>
			</tr>




			<!-- Patient Information -->
			<tr> <td colspan="5"><div class="my-10"></div></td> </tr>
			</tr>
				<td colspan="5" class="font-weight-bolder"> Patient Information </td>
			</tr>
			<tr>
				<td colspan="2">Name: <?= $model->theValue('patient_name') ?></td>
				<td>Age: <?= $model->theValue('patient_age') ?></td>
				<td>Gender: <?= $model->theValue('genderLabel') ?></td>
			</tr>
			<tr>
				<td colspan="5">Contact Information (if different from requesting party): <?= $model->theValue('patient_contact') ?></td>
			</tr>




			<!-- Incident Information -->
			<tr> <td colspan="5"><div class="my-10"></div></td> </tr>
			</tr>
				<td colspan="5" class="font-weight-bolder"> Incident Information </td>
			</tr>
			<tr>
				<td colspan="5">Location of Incident: <?= $model->theValue('incident_location') ?></td>
			</tr>
			<tr>
				<td colspan="5">Nature of Incident (medical, accident, patient transfer, etc): <?= $model->theValue('incident_nature') ?></td>
			</tr>
			<tr>
				<td colspan="5">Incident Severity Level: <?= $model->theValue('incident_level') ?></td>
			</tr>


			<!-- Dispatch Information -->
			<tr> <td colspan="5"><div class="my-10"></div></td> </tr>
			</tr>
				<td colspan="5" class="font-weight-bolder"> Dispatch Information </td>
			</tr>
			<tr>
				<td colspan="2">
					Dispatched Unit(s) ID: <?= $model->theValue('unit_id') ?>
				</td>
				<td colspan="3">Dispatched Time: <?= $model->theValue('dispatched_time') ?></td>
			</tr>
			<tr>
				<td colspan="5">
					Arrival Time at Scene: <?= $model->theValue('arrival_time') ?>
				</td>
			</tr>
			<tr>
				<td colspan="5">
					Departure Time from Scene: <?= $model->theValue('departure_time') ?>
				</td>
			</tr>
			<tr>
				<td colspan="5">
					Arrival Time at Hospital/Facility: <?= $model->theValue('arrival_time_facility') ?>
				</td>
			</tr>
			<tr>
				<td colspan="5">
					Patient Condition: 
				</td>
			</tr>


			<tr>
				<td colspan="5" style="height: 7rem; vertical-align: top;">
					<?= $model->theValue('patient_condition') ?>
				</td>
			</tr>
			<tr><td class="page-break" colspan="5"></td></tr>

			<!-- Condition Upon Arrival: -->
			<tr>
				<td colspan="5">
					Condition Upon Arrival:
				</td>
			</tr>
			<tr>
				<td colspan="5">
					Vitals
				</td>
			</tr>
			<tr>
				<td>Heart rate: <?= $model->theValue('heart_rate') ?></td>
				<td>Blood pressure: <?= $model->theValue('blood_pressure') ?></td>
				<td>SpO2: <?= $model->theValue('spo2') ?></td>
			</tr>
			<tr>
				<td colspan="5">
					Brief Description of Symptoms:
				</td>
			</tr>
			<tr>
				<td colspan="5" style="height: 7rem; vertical-align: top;">
					<?= $model->theValue('description_of_symptoms') ?>
				</td>
			</tr>
			<tr>
				<td colspan="5">
					Treatment Administered: 
				</td>
			</tr>
			<tr>
				<td colspan="5" style="height: 7rem; vertical-align: top;">
					<?= $model->theValue('treatment_administered') ?>
				</td>
			</tr>
			<tr> <td colspan="5"><hr></td> </tr>


			<!-- Hospital/Facility Information -->
			<tr> <td colspan="5"><div class="my-10"></div></td> </tr>
			</tr>
				<td colspan="5" class="font-weight-bolder"> Hospital/Facility Information </td>
			</tr>
			<tr>
				<td colspan="5">
					Name of Facility: <?= $model->theValue('facility_name') ?>
				</td>
			</tr>
			<tr>
				<td colspan="5">
					Contact Information: <?= $model->theValue('facility_contact') ?>
				</td>
			</tr>
			<tr>
				<td colspan="5">
					Receiving Doctor/Nurse: <?= $model->theValue('facility_receiver') ?>
				</td>
			</tr>


			<!-- ERT Information -->
			<tr> <td colspan="5"><div class="my-10"></div></td> </tr>
			</tr>
				<td colspan="5" class="font-weight-bolder"> ERT Information </td>
			</tr>

			<tr>
				<td colspan="5"> Names: </td>
			</tr>
			<?= App::foreach($model->ert_names, fn ($ert) => <<< HTML
				<tr>
					<td colspan="5"> {$ert['name']} - {$ert['role']} </td>
				</tr>
			HTML) ?>

			<tr> <td colspan="5"><hr></td> </tr>
			<tr><td class="page-break" colspan="5"></td></tr>


			<!-- Vehicle Information -->
			</tr>
				<td colspan="5" class="font-weight-bolder"> Vehicle Information </td>
			</tr>

			<tr>
				<td colspan="2"> Vehicle ID: <?= $model->vehicle_id ?></td>
				<td colspan="3"> Vehicle Type (ambulance, rescue vehicle, etc.): <?= $model->theValue('vehicle_type') ?></td>
			</tr>
			<tr>
				<td colspan="2"> Vehicle Mileage: <?= $model->theValue('vehicle_mileage') ?></td>
			</tr>


			<tr> <td colspan="5"><div class="my-10"></div></td> </tr>
			</tr>
				<td colspan="5" class="font-weight-bolder"> Notes: </td>
			</tr>
			<tr>
				<td colspan="5" style="height: 10rem; vertical-align: top;">
					<?= $model->theValue('notes') ?>
				</td>
			</tr>


			<tr>
				<td colspan="3">Prepared By: </td>
				<td colspan="2">Noted by: </td>
			</tr>

			<tr>
				<td colspan="5"><div class="my-5"></div></td>
			</tr>


			<tr>
				<td colspan="3" class="font-weight-bolder"><?= $model->theValue('prepared_by') ?> </td>
				<td colspan="2" class="font-weight-bolder"><?= $model->theValue('noted_by') ?> </td>
			</tr>

			<tr>
				<td colspan="5"><div class="my-20"></div></td>
			</tr>

			<tr>
				<td colspan="3" > </td>
				<td colspan="2" class="font-weight-bolder"><?= $model->theValue('mdrrmo', 'Erberto A. Astrera') ?> </td>
			</tr>
			<tr>
				<td colspan="3" > </td>
				<td colspan="2" class="font-weight-bolder">MDRRMO</td>
			</tr>


			<tr><td class="page-break" colspan="5"></td></tr>
			<tr>
				<td colspan="5" class="font-weight-bolder">Photo(s):</td>
			</tr>

			<tr>
				<td colspan="5">
					<?= App::foreach($model->filePhotos, fn ($file) => Html::image($file, ['w' => 200], ['class' => 'img-fluid symbol', 'style' => 'height: 200px;'])) ?>
				</td>
			</tr>


			<tr> <td colspan="5"><div class="my-10"></div></td> </tr>
			<tr>
				<td colspan="5" class="font-weight-bolder">Attachments: </td>
			</tr>

			<?= App::foreach($model->fileAttachments, function ($file) {
				return <<< HTML
					<tr>
						<td>
							{$file->show([
					            'class' => 'img-fluid',
					            'loading' => 'lazy',
					            'width' => 100,
					            'style' => 'border-radius: 4px;width: 80px; height: 80px'
					        ], 100)}
						</td>
						<td colspan="4">
							<div>Filename: {$file->nameWithExtension}</div>
							<div>Link: {$file->getDownloadUrl(true)}</div>
							<div>Size: {$file->fileSize}</div>
						</td>
					</tr>
				HTML;
			}) ?>
		</tbody>

	</table>

</div>        
