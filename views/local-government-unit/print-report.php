<?php

$this->params['size'] = 'landscape';
$this->registerCss(<<< CSS
	.printable {width: 100%; color: #000;}
	td, th { padding:0.5rem; }
	th { background: #e6b8b8 !important;}
	.bg-orange { background: #e26c0a !important; padding: 0.1rem !important}
CSS);
?>

<table class="printable" border="1">
	<tbody>
		<tr>
			<th width="25%"> Name of LGU </th>
			<td width="25%"> <?= $model->lgu_name ?> </td>
			<th width="25%"> LGU Classification </th>
			<td> <?= $model->lgu_classification ?> </td>
		</tr>
		<tr>
			<th width="25%"> Province (for City/Municipality) </th>
			<td width="25%"> <?= $model->lgu_address ?> </td>
			<th width="25%"> Region </th>
			<td> <?= $model->lgu_region ?> </td>
		</tr>
		<tr>
			<td colspan="4" class="text-center bg-orange">
				ASSESSED BY:
			</td>
		</tr>
		<tr>
			<th>name</th>
			<td colspan="3"><?= $model->name ?></td>
		</tr>
		<tr>
			<th>position</th>
			<td colspan="3"><?= $model->position ?></td>
		</tr>
		<tr>
			<th>contact number</th>
			<td colspan="3"><?= $model->contact_no ?></td>
		</tr>
		<tr>
			<th>email address</th>
			<td colspan="3"><?= $model->email ?></td>
		</tr>
		<tr>
			<th>date of assessment</th>
			<td colspan="3"><?= $model->date_of_assessment ?></td>
		</tr>
		<tr>
			<th>date submitted</th>
			<td colspan="3"><?= $model->date_submitted ?></td>
		</tr>
	</tbody>
</table>