<?php

use app\helpers\App;
use app\helpers\Html;
use app\widgets\Detail;

$this->params['title'] = 'Approved Ambulance Request';
?>

<p> Good day <?= $user->fullname ?>! </p>
<p> This is to inform you that an ambulance request was approved </p>

<table style="width: 100%">
	<tbody>
		<tr>
			<td colspan="2">
				<p class="lead text-uppercase font-weight-bold" style="text-transform: uppercase; font-weight: bold; margin-top: 2em; font-size: 1.1em;">Patient Information</p>
			</td>
		</tr>
		
		<tr>
			<th><?= $model->getAttributeLabel('name') ?></th>
			<td>: <?= $model->name ?></td>
		</tr>

		<tr>
			<th><?= $model->getAttributeLabel('sexLabel') ?></th>
			<td>: <?= $model->sexLabel ?></td>
		</tr>

		<tr>
			<th><?= $model->getAttributeLabel('ambulanceStatusBadge') ?></th>
			<td>: <?= $model->ambulanceStatusBadge ?></td>
		</tr>

		<tr>
			<th><?= $model->getAttributeLabel('address') ?></th>
			<td>: <?= $model->address ?></td>
		</tr>
		<tr>
			<th><?= $model->getAttributeLabel('pickup_address') ?></th>
			<td>: <?= $model->pickup_address ?></td>
		</tr>
		<tr>
			<th><?= $model->getAttributeLabel('chief_complaint') ?></th>
			<td>: <?= $model->chief_complaint ?></td>
		</tr>
		<tr>
			<th><?= $model->getAttributeLabel('other_complaints') ?></th>
			<td>: <?= $model->other_complaints ?: 'None' ?></td>
		</tr>
		<tr>
			<th><?= $model->getAttributeLabel('destination') ?></th>
			<td>: <?= $model->destination ?: 'None' ?></td>
		</tr>

		<tr>
			<th><?= $model->getAttributeLabel('description') ?></th>
			<td>: <?= $model->description ?: 'None' ?></td>
		</tr>

		<tr>
			<td colspan="2">
				<p class="lead text-uppercase font-weight-bold" style="text-transform: uppercase; font-weight: bold; margin-top: 3em; font-size: 1.1em;">Other Details</p>
			</td>
		</tr>
		<tr>
			<th><?= $model->getAttributeLabel('driver') ?></th>
			<td>: <?= $model->driver ?: 'None' ?></td>
		</tr>
		<tr>
			<th><?= $model->getAttributeLabel('responders') ?></th>
			<td><?= App::ifElse($model->responders, fn($responders) => Html::tag('ul', App::foreach($responders, fn($responder) => Html::tag('li', $responder)), ['style' => 'padding: 0;']), ': None') ?></td>
		</tr>
		<tr>
			<th><?= $model->getAttributeLabel('patient_companions') ?></th>
			<td><?= App::ifElse($model->patient_companions, fn($patient_companions) => Html::tag('ul', App::foreach($patient_companions, fn($companion) => Html::tag('li', $companion)), ['style' => 'padding: 0;']), ': None') ?></td>
		</tr>

	</tbody>
</table>

<button style="padding: 10px 15px; background: #ca1500; border-radius: 4px; border: unset;    margin-top: 2em;">
	<a href="<?= $model->viewUrl ?>" class="btn btn-primary" style="color: #ffffff; text-decoration: unset; text-transform: uppercase;">
		View Request
	</a>
</button>
