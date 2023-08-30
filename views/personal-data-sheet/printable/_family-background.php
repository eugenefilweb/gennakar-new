<?php

use app\helpers\Html;
?>

<table border="1">
	<tbody>
		<tr>
			<td class="border-hidden" width="18%"></td>
			<td class="border-hidden" width="20%"></td>
			<td class="border-hidden" width="16%"></td>
			<td class="border-hidden"></td>
			<td class="border-hidden" width="18%"></td>
		</tr>

		<tr>
			<td colspan="5" class="font-size-1_1rem bg-gray text-white">
				<em>
					<b>II. FAMILY BACKGROUND</b>
				</em>
			</td>
		</tr>

		<tr class="row-height">
			<td class="bg-light-gray border-bottom-hidden">22. SPOUSE'S SURNAME</td>
			<td colspan="2"> <?= $model->theValue('spouse_surname') ?> </td>
			<td class="bg-light-gray">23. NAME of CHILDREN <small>(Write full name and list all)</small></td>
			<td class="bg-light-gray">DATE OF BIRTH <small>(mm/dd/yyyy)</small></td>
		</tr>

		<tr class="row-height">
			<td class="bg-light-gray border-bottom-hidden pl-7">  FIRST NAME </td>
			<td> <?= $model->theValue('spouse_first_name') ?> </td>
			<td class="vertical-align-top pt-0 bg-light-gray line-height-md">
				<div class="line-height-md"><small>NAME EXTENSION (JR., SR)</small></div>
				<div><?= $model->theValue('spouse_name_extension') ?></div>
			</td>
			<td><?= $model->getChildrenData(0) ?></td>
			<td><?= $model->getChildrenData(0, 'birthdate') ?></td>
		</tr>
		<tr class="row-height">
			<td class="bg-light-gray pl-7"> MIDDLE NAME </td>
			<td colspan="2"><?= $model->theValue('spouse_middle_name') ?></td>
			<td><?= $model->getChildrenData(1) ?></td>
			<td><?= $model->getChildrenData(1, 'birthdate') ?></td>
		</tr>
		<tr class="row-height">
			<td class="bg-light-gray pl-7"> OCCUPATION </td>
			<td colspan="2"><?= $model->theValue('spouse_occupation') ?></td>
			<td><?= $model->getChildrenData(2) ?></td>
			<td><?= $model->getChildrenData(2, 'birthdate') ?></td>
		</tr>
		<tr class="row-height">
			<td class="bg-light-gray pl-7"> EMPLOYER/BUSINESS NAME </td>
			<td colspan="2"><?= $model->theValue('spouse_employer') ?></td>
			<td><?= $model->getChildrenData(3) ?></td>
			<td><?= $model->getChildrenData(3, 'birthdate') ?></td>
		</tr>
		<tr class="row-height">
			<td class="bg-light-gray pl-7"> BUSINESS ADDRESS </td>
			<td colspan="2"><?= $model->theValue('spouse_employer_address') ?></td>
			<td><?= $model->getChildrenData(4) ?></td>
			<td><?= $model->getChildrenData(4, 'birthdate') ?></td>
		</tr>
		<tr class="row-height">
			<td class="bg-light-gray pl-7"> TELEPHONE NO. </td>
			<td colspan="2"><?= $model->theValue('spouse_employer_telephone_no') ?></td>
			<td><?= $model->getChildrenData(5) ?></td>
			<td><?= $model->getChildrenData(5, 'birthdate') ?></td>
		</tr>

		<tr class="row-height">
			<td class="bg-light-gray border-bottom-hidden">24. FATHER'S SURNAME</td>
			<td colspan="2"> <?= $model->theValue('father_surname') ?> </td>
			<td><?= $model->getChildrenData(6) ?></td>
			<td><?= $model->getChildrenData(6, 'birthdate') ?></td>
		</tr>
		<tr class="row-height">
			<td class="bg-light-gray border-bottom-hidden pl-7"> FIRST NAME </td>
			<td> <?= $model->theValue('father_first_name') ?> </td>
			<td class="vertical-align-top pt-0 bg-light-gray line-height-md">
				<div class="line-height-md"><small>NAME EXTENSION (JR., SR)</small></div>
				<div><?= $model->theValue('father_name_extension') ?></div>
			</td>
			<td><?= $model->getChildrenData(7) ?></td>
			<td><?= $model->getChildrenData(7, 'birthdate') ?></td>
		</tr>
		<tr class="row-height">
			<td class="bg-light-gray pl-7"> MIDDLE NAME </td>
			<td colspan="2"><?= $model->theValue('father_middle_name') ?></td>
			<td><?= $model->getChildrenData(8) ?></td>
			<td><?= $model->getChildrenData(8, 'birthdate') ?></td>
		</tr>

		<tr class="row-height">
			<td class="bg-light-gray border-right-hidden border-bottom-hidden">25. MOTHER'S MAIDEN NAME</td>
			<td class="bg-light-gray" colspan="2"></td>
			<td><?= $model->getChildrenData(9) ?></td>
			<td><?= $model->getChildrenData(9, 'birthdate') ?></td>
		</tr>

		<tr class="row-height">
			<td class="bg-light-gray border-bottom-hidden pl-7"> SURNAME</td>
			<td colspan="2"> <?= $model->theValue('mother_surname') ?> </td>
			<td><?= $model->getChildrenData(10) ?></td>
			<td><?= $model->getChildrenData(10, 'birthdate') ?></td>
		</tr>
		<tr class="row-height">
			<td class="bg-light-gray border-bottom-hidden pl-7"> FIRST NAME </td>
			<td colspan="2"> <?= $model->theValue('mother_first_name') ?> </td>
			<td><?= $model->getChildrenData(11) ?></td>
			<td><?= $model->getChildrenData(11, 'birthdate') ?></td>
		</tr>
		<tr class="row-height">
			<td class="bg-light-gray pl-7">  MIDDLE NAME </td>
			<td colspan="2"><?= $model->theValue('mother_middle_name') ?></td>
			<td colspan="2" class="text-center text-danger bg-light-gray">
				<small><em><b>(Continue on separate sheet if necessary)</b></em></small>
			</td>
		</tr>
	</tbody>
</table>