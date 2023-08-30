<?php

use app\helpers\App;
use app\helpers\Html;
?>

<tr>
	<td colspan="11" class="font-size-1_1rem bg-gray text-white">
		<em>
			<b>II. FAMILY BACKGROUND</b>
		</em>
	</td>
</tr>

<tr class="row-height">
	<td colspan="2" class="bg-light-gray border-bottom-hidden">22. SPOUSE'S SURNAME</td>
	<td colspan="3"> <?= $model->theValue('spouse_surname') ?> </td>
	<td class="bg-light-gray" colspan="4">23. NAME of CHILDREN <small>(Write full name and list all)</small></td>
	<td class="bg-light-gray" colspan="2">DATE OF BIRTH <small>(mm/dd/yyyy)</small></td>
</tr>

<tr class="row-height">
	<td colspan="2" class="bg-light-gray border-bottom-hidden pl-7">  FIRST NAME </td>
	<td colspan="2"> <?= $model->theValue('spouse_first_name') ?> </td>
	<td class="vertical-align-top pt-0 bg-light-gray line-height-md">
		<div class="line-height-md"><small>NAME EXTENSION (JR., SR)</small></div>
		<div><?= $model->theValue('spouse_name_extension') ?></div>
	</td>
	<td colspan="4"><?= $model->getChildrenData(0) ?></td>
	<td colspan="2"><?= $model->getChildrenData(0, 'birthdate') ?></td>
</tr>
<tr class="row-height">
	<td colspan="2" class="bg-light-gray pl-7"> MIDDLE NAME </td>
	<td colspan="3"><?= $model->theValue('spouse_middle_name') ?></td>
	<td colspan="4"><?= $model->getChildrenData(1) ?></td>
	<td colspan="2"><?= $model->getChildrenData(1, 'birthdate') ?></td>
</tr>
<tr class="row-height">
	<td colspan="2" class="bg-light-gray pl-7"> OCCUPATION </td>
	<td colspan="3"><?= $model->theValue('spouse_occupation') ?></td>
	<td colspan="4"><?= $model->getChildrenData(2) ?></td>
	<td colspan="2"><?= $model->getChildrenData(2, 'birthdate') ?></td>
</tr>
<tr class="row-height">
	<td colspan="2" class="bg-light-gray pl-7"> EMPLOYER/BUSINESS NAME </td>
	<td colspan="3"><?= $model->theValue('spouse_employer') ?></td>
	<td colspan="4"><?= $model->getChildrenData(3) ?></td>
	<td colspan="2"><?= $model->getChildrenData(3, 'birthdate') ?></td>
</tr>
<tr class="row-height">
	<td colspan="2" class="bg-light-gray pl-7"> BUSINESS ADDRESS </td>
	<td colspan="3"><?= $model->theValue('spouse_employer_address') ?></td>
	<td colspan="4"><?= $model->getChildrenData(4) ?></td>
	<td colspan="2"><?= $model->getChildrenData(4, 'birthdate') ?></td>
</tr>
<tr class="row-height">
	<td colspan="2" class="bg-light-gray pl-7"> TELEPHONE NO. </td>
	<td colspan="3"><?= $model->theValue('spouse_employer_telephone_no') ?></td>
	<td colspan="4"><?= $model->getChildrenData(5) ?></td>
	<td colspan="2"><?= $model->getChildrenData(5, 'birthdate') ?></td>
</tr>

<tr class="row-height">
	<td colspan="2" class="bg-light-gray border-bottom-hidden">24. FATHER'S SURNAME</td>
	<td colspan="3"> <?= $model->theValue('father_surname') ?> </td>
	<td colspan="4"><?= $model->getChildrenData(6) ?></td>
	<td colspan="2"><?= $model->getChildrenData(6, 'birthdate') ?></td>
</tr>
<tr class="row-height">
	<td colspan="2" class="bg-light-gray border-bottom-hidden pl-7"> FIRST NAME </td>
	<td colspan="2"> <?= $model->theValue('father_first_name') ?> </td>
	<td class="vertical-align-top pt-0 bg-light-gray line-height-md">
		<div class="line-height-md"><small>NAME EXTENSION (JR., SR)</small></div>
		<div><?= $model->theValue('father_name_extension') ?></div>
	</td>
	<td colspan="4"><?= $model->getChildrenData(7) ?></td>
	<td colspan="2"><?= $model->getChildrenData(7, 'birthdate') ?></td>
</tr>
<tr class="row-height">
	<td colspan="2" class="bg-light-gray pl-7"> MIDDLE NAME </td>
	<td colspan="3"><?= $model->theValue('father_middle_name') ?></td>
	<td colspan="4"><?= $model->getChildrenData(8) ?></td>
	<td colspan="2"><?= $model->getChildrenData(8, 'birthdate') ?></td>
</tr>

<tr class="row-height">
	<td colspan="2" class="bg-light-gray border-right-hidden border-bottom-hidden">25. MOTHER'S MAIDEN NAME</td>
	<td class="bg-light-gray" colspan="3"></td>
	<td colspan="4"><?= $model->getChildrenData(9) ?></td>
	<td colspan="2"><?= $model->getChildrenData(9, 'birthdate') ?></td>
</tr>

<tr class="row-height">
	<td colspan="2" class="bg-light-gray border-bottom-hidden pl-7"> SURNAME</td>
	<td colspan="3"> <?= $model->theValue('mother_surname') ?> </td>
	<td colspan="4"><?= $model->getChildrenData(10) ?></td>
	<td colspan="2"><?= $model->getChildrenData(10, 'birthdate') ?></td>
</tr>
<tr class="row-height">
	<td colspan="2" class="bg-light-gray border-bottom-hidden pl-7"> FIRST NAME </td>
	<td colspan="3"> <?= $model->theValue('mother_first_name') ?> </td>
	<td colspan="4"><?= $model->getChildrenData(11) ?></td>
	<td colspan="2"><?= $model->getChildrenData(11, 'birthdate') ?></td>
</tr>
<tr class="row-height">
	<td colspan="2" class="bg-light-gray pl-7">  MIDDLE NAME </td>
	<td colspan="3"><?= $model->theValue('mother_middle_name') ?></td>
	<td colspan="4"><?= $model->getChildrenData(12) ?></td>
	<td colspan="2"><?= $model->getChildrenData(12, 'birthdate') ?></td>
</tr>

<?= App::foreach($model->extendedChildrens, fn ($children) => Html::tag('tr', implode('', [
	Html::tag('td', '', ['class' => 'bg-light-gray pl-7', 'colspan' => 2]),
	Html::tag('td', '', ['colspan' => '3']),
	Html::tag('td', $children['name'] ?? '', ['colspan' => 4]),
	Html::tag('td', App::formatter()->asDateFormat($children['birthdate'] ?? '', 'm/d/Y'), ['colspan' => 2]),
]), [
	'class' => 'row-height'
])) ?>