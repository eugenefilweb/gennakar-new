<?php

use app\helpers\Html;
use app\models\Passenger;
?>
<div class="p-h1p2rem"></div>

<table width="100%">
	<tbody>
		<tr>
			<td class="text-center td-header font-weight-bolder p-btcb">VEHICLE #<?= $v_counter ?></td>
			<td class="text-center td-header p-btcb p-bbcb" colspan="2">License Plate Number</td>
			<td class="text-center" colspan="2"><?= $passenger->plateNo ?></td>
		</tr>
		<tr>
			<td class="text-center td-header" rowspan="2"> Passenger <?= $counter ?> Full Name </td>
			<td width="20%" class="text-center font-weight-bold">Surname</td>
			<td width="20%" class="text-center font-weight-bold">First Name</td>
			<td width="20%" class="text-center font-weight-bold">Middle Name</td>
			<td width="10%" class="text-center font-weight-bold">Suffix</td>
		</tr>
		<tr>
			<td class="text-center"><?= $passenger->last_name ?></td>
			<td class="text-center"><?= $passenger->first_name ?></td>
			<td class="text-center"><?= $passenger->middle_name ?></td>
			<td class="text-center"><?= $passenger->suffix_name ?></td>
		</tr>
		<tr>
			<td class="text-center td-header">Passenger <?= $counter ?> Complete Address </td>
			<td class="text-center" colspan="4"> <?= $passenger->address ?> </td>
		</tr>
		<tr>
			<td class="text-center td-header">Passenger <?= $counter ?> Email Address</td>
			<td class="text-center" colspan="4"> <?= $passenger->email ?> </td>
		</tr>
		<tr>
			<td class="text-center td-header">Contact Number</td>
			<td class="text-center"><?= $passenger->contact_no ?></td>
			<td class="text-center td-header">Alternate Contact Number</td>
			<td class="text-center" colspan="2"><?= $passenger->alternate_contact_no ?></td>
		</tr>
		<tr>
			<td class="text-center td-header">Age</td>
			<td class="text-center"><?= $passenger->age ?></td>
			<td class="text-center td-header p-bbcb">Sex</td>
			<td class="text-center" colspan="2"><?= $passenger->sexLabel ?></td>
		</tr>

		<tr>
			<td class="text-center td-header p-bbcb">Existing Health Condition <br> (if applicable)</td>
			<td class="text-center" colspan="4"> <?= $passenger->health_condition ?> </td>
		</tr>
	</tbody>
</table>
<div class="p-h1p2rem"></div>
<table width="100%">
	<tbody>
		<tr>
			<td class="text-center td-header p-bbcb" colspan="3">Initial Medical Complaint / Observation (at scene of accident)</td>
		</tr>
		<tr>
			<td class="td-header p-bbcb" colspan="3">Check all that applies</td>
		</tr>

		<tr>
			<td width="33.33%">
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "medical_complaint[{$v_counter}][{$counter}]", '', [
                            'checked' => trim($passenger->medical_complaint) == $passenger->getParamMedicalComplaint(0)
                        ]) ?>
                        <span></span><?= $passenger->getParamMedicalComplaint(0) ?>
                    </label>
                </div>
			</td>
			<td width="33.33%">
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "medical_complaint[{$v_counter}][{$counter}]", '', [
                            'checked' => trim($passenger->medical_complaint) == $passenger->getParamMedicalComplaint(1)
                        ]) ?>
                        <span></span><?= $passenger->getParamMedicalComplaint(1) ?>
                    </label>
                </div>
			</td>
			<td width="33.33%">
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "medical_complaint[{$v_counter}][{$counter}]", '', [
                            'checked' => trim($passenger->medical_complaint) == $passenger->getParamMedicalComplaint(2)
                        ]) ?>
                        <span></span><?= $passenger->getParamMedicalComplaint(2) ?>
                    </label>
                </div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "medical_complaint[{$v_counter}][{$counter}]", '', [
                            'checked' => trim($passenger->medical_complaint) == $passenger->getParamMedicalComplaint(3)
                        ]) ?>
                        <span></span><?= $passenger->getParamMedicalComplaint(3) ?>
                    </label>
                </div>
			</td>
			<td>
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "medical_complaint[{$v_counter}][{$counter}]", '', [
                            'checked' => trim($passenger->medical_complaint) == $passenger->getParamMedicalComplaint(4)
                        ]) ?>
                        <span></span><?= $passenger->getParamMedicalComplaint(4) ?>
                    </label>
                </div>
			</td>
			<td>
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "medical_complaint[{$v_counter}][{$counter}]", '', [
                            'checked' => trim($passenger->medical_complaint) == $passenger->getParamMedicalComplaint(5)
                        ]) ?>
                        <span></span><?= $passenger->getParamMedicalComplaint(5) ?>
                    </label>
                </div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "medical_complaint[{$v_counter}][{$counter}]", '', [
                            'checked' => trim($passenger->medical_complaint) == $passenger->getParamMedicalComplaint(6)
                        ]) ?>
                        <span></span><?= $passenger->getParamMedicalComplaint(6) ?>
                    </label>
                </div>
			</td>
			<td>
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "medical_complaint[{$v_counter}][{$counter}]", '', [
                            'checked' => trim($passenger->medical_complaint) == $passenger->getParamMedicalComplaint(7)
                        ]) ?>
                        <span></span><?= $passenger->getParamMedicalComplaint(7) ?>
                    </label>
                </div>
			</td>
			<td>
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "medical_complaint[{$v_counter}][{$counter}]", '', [
                            'checked' => trim($passenger->medical_complaint) == $passenger->getParamMedicalComplaint(8)
                        ]) ?>
                        <span></span><?= $passenger->getParamMedicalComplaint(8) ?>
                    </label>
                </div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "medical_complaint[{$v_counter}][{$counter}]", '', [
                            'checked' => trim($passenger->medical_complaint) == $passenger->getParamMedicalComplaint(9)
                        ]) ?>
                        <span></span><?= $passenger->getParamMedicalComplaint(9) ?>
                    </label>
                </div>
			</td>
			<td>
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "medical_complaint[{$v_counter}][{$counter}]", '', [
                            'checked' => trim($passenger->medical_complaint) == $passenger->getParamMedicalComplaint(10)
                        ]) ?>
                        <span></span><?= $passenger->getParamMedicalComplaint(10) ?>
                    </label>
                </div>
			</td>
			<td>
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "medical_complaint[{$v_counter}][{$counter}]", '', [
                            'checked' => trim($passenger->medical_complaint) == $passenger->getParamMedicalComplaint(11)
                        ]) ?>
                        <span></span><?= $passenger->getParamMedicalComplaint(11) ?>
                    </label>
                </div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "medical_complaint[{$v_counter}][{$counter}]", '', [
                            'checked' => trim($passenger->medical_complaint) == $passenger->getParamMedicalComplaint(12)
                        ]) ?>
                        <span></span><?= $passenger->getParamMedicalComplaint(12) ?>
                    </label>
                </div>
			</td>
			<td>
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "medical_complaint[{$v_counter}][{$counter}]", '', [
                            'checked' => trim($passenger->medical_complaint) == $passenger->getParamMedicalComplaint(13)
                        ]) ?>
                        <span></span><?= $passenger->getParamMedicalComplaint(13) ?>
                    </label>
                </div>
			</td>
			<td>
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "medical_complaint[{$v_counter}][{$counter}]", '', [
                            'checked' => trim($passenger->medical_complaint) == $passenger->getParamMedicalComplaint(14)
                        ]) ?>
                        <span></span><?= $passenger->getParamMedicalComplaint(14) ?>
                    </label>
                </div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "medical_complaint[{$v_counter}][{$counter}]", '', [
                            'checked' => trim($passenger->medical_complaint) == $passenger->getParamMedicalComplaint(15)
                        ]) ?>
                        <span></span><?= $passenger->getParamMedicalComplaint(15) ?>
                    </label>
                </div>
			</td>
			<td>
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "medical_complaint[{$v_counter}][{$counter}]", '', [
                            'checked' => trim($passenger->medical_complaint) == $passenger->getParamMedicalComplaint(16)
                        ]) ?>
                        <span></span><?= $passenger->getParamMedicalComplaint(16) ?>
                    </label>
                </div>
			</td>
			<td>
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "medical_complaint[{$v_counter}][{$counter}]", '', [
                            'checked' => ($passenger->otherMedicalComplaint ? true: false)
                        ]) ?>
                        <span></span>Others: <?= $passenger->otherMedicalComplaint ?>
                    </label>
                </div>
			</td>
		</tr>
		<tr>
			<td colspan="3"></td>
		</tr>
		<tr>
			<td class="td-header p-bbcb">Condition</td>
			<td>
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "condition[{$v_counter}][{$counter}]", '', [
                            'checked' => $passenger->condition == Passenger::NON_FATAL
                        ]) ?>
                        <span></span>Non-fatal
                    </label>
                </div>
			</td>
			<td>
				<div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', "condition[{$v_counter}][{$counter}]", '', [
                            'checked' => $passenger->condition == Passenger::FATAL
                        ]) ?>
                        <span></span>Fatal
                    </label>
                </div>
			</td>
		</tr>
		<tr>
			<td colspan="3" class="brh blh p-0">
				<div class="p-h1p2rem"></div>
			</td>
		</tr>
		<tr>
			<td colspan="3" class="td-header p-bbcb text-center">Remarks/Observation </td>
		</tr>
		<tr class="p-h40rem">
			<td colspan="3" class="p-vat"> <?= $passenger->observation ?> </td>
		</tr>
		<tr>
			<td colspan="3" class="brh blh p-0">
				<div class="p-h1p2rem"></div>
			</td>
		</tr>
		<tr>
			<td class="td-header p-bbcb text-center p-brw">Prepared by</td>
			<td class="td-header p-bbcb text-center p-brw">Noted by</td>
			<td class="td-header p-bbcb text-center">Date</td>
		</tr>
		<tr class="p-h5rem">
			<td class="text-center"><?= $passenger->preferred_by ?></td>
			<td class="text-center"><?= $passenger->noted_by ?></td>
			<td class="text-center"><?= $passenger->date ?></td>
		</tr>
	</tbody>
</table>
<div class="page-break"> </div>
