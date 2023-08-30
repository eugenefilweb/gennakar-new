<?php

use app\helpers\Html;
use app\models\PersonalDataSheet;
?>

<table border="1">
	<tbody>
		<tr>
			<td class="border-hidden" width="18%"></td>
			<td class="border-hidden" width="10%"></td>
			<td class="border-hidden" width="10%"></td>
			<td class="border-hidden" width="16%"></td>
			<td class="border-hidden"></td>
			<td class="border-hidden"></td>
			<td class="border-hidden"></td>
			<td class="border-hidden"></td>
			<td class="border-hidden"></td>
		</tr>

		<tr>
			<td colspan="9" class="font-size-1_1rem bg-gray text-white">
				<em>
					<b>I. PERSONAL INFORMATION</b>
				</em>
			</td>
		</tr>
		<tr class="row-height">
			<td class="bg-light-gray border-bottom-hidden">2. SURNAME</td>
			<td colspan="8"><?= $model->theValue('surname') ?></td>
		</tr>
		<tr>
			<td class="bg-light-gray border-bottom-hidden pl-4">FIRST NAME</td>
			<td colspan="5"><?= $model->theValue('first_name') ?></td>
			<td colspan="3" class="vertical-align-top pt-0 bg-light-gray line-height-md">
				<div><small>NAME EXTENSION (JR., SR)</small></div>
				<div><?= $model->theValue('name_extension') ?></div>
			</td>
		</tr>
		<tr class="row-height">
			<td class="bg-light-gray pl-4">MIDDLE NAME</td>
			<td colspan="8"><?= $model->theValue('middle_name') ?></td>
		</tr>

		<tr>
			<td rowspan="2" class="vertical-align-top bg-light-gray line-height-md">
				3. DATE OF BIRTH
				<div><small>(mm/dd/yyyy)</small></div>
			</td>
			<td colspan="2" rowspan="2">
				<?= $model->theValue('date_of_birth') ?>
			</td>
			<td colspan="2" rowspan="2" class="vertical-align-top bg-light-gray">16. CITIZENSHIP</td>
			<td rowspan="2" class="border-right-hidden vertical-align-top">
				<?= Html::input('checkbox', '', '', [
					'checked' => $model->citizenship == PersonalDataSheet::FILIPINO,
					'disabled' => true
				]) ?>
				Filipino 
			</td>
			<td rowspan="2" class="vertical-align-top text-right border-right-hidden">
				<?= Html::input('checkbox', '', '', ['checked' => $model->citizenship == PersonalDataSheet::DUAL_CITIZENSHIP]) ?>
			</td>
			<td colspan="2" class="border-bottom-hidden">Dual Citizenship</td>
		</tr>

		<tr>
			<td class="border-right-hidden border-bottom-hidden">
				<label>
				<?= Html::input('checkbox', '', '', ['checked' => $model->citizenship_type == PersonalDataSheet::BIRTH]) ?>
					by birth
				</label>
			</td>
			<td class="border-bottom-hidden">
				<label>
				<?= Html::input('checkbox', '', '', ['checked' => $model->citizenship_type == PersonalDataSheet::NATURALIZATION]) ?>
					by naturalization
				</label>
			</td>
		</tr>

		<tr class="row-height">
			<td class="bg-light-gray">4. PLACE OF BIRTH</td>
			<td colspan="2"><?= $model->theValue('place_of_birth') ?></td>
			<td colspan="2" class="text-center border-bottom-hidden border-top-hidden bg-light-gray">
				<small>If holder of dual citizenship, </small>
			</td>
			<td colspan="2" class="border-top-hidden border-right-hidden">
				
			</td>
			<td colspan="2">
				Pls. indicate country: <?= $model->theValue('dual_citizenship_country') ?>
			</td>
		</tr>

		<tr class="row-height">
			<td class="bg-light-gray">5. SEX</td>
			<td>
				<label>
					<?= Html::input('checkbox', '', '', ['checked' => $model->sex == PersonalDataSheet::MALE]) ?>
					Male
				</label>
			</td>
			<td>
				<label>
					<?= Html::input('checkbox', '', '', ['checked' => $model->sex == PersonalDataSheet::FEMALE]) ?>
					Female
				</label>
			</td>
			<td colspan="2" class="text-center bg-light-gray">
				<small>please indicate the details.</small>
			</td>
			<td colspan="4">
				<?= $model->theValue('dual_citizenship_details') ?>
			</td>
		</tr>

		<tr>
			<td rowspan="2" class="vertical-align-top bg-light-gray">6. CIVIL STATUS</td>
			<td class="vertical-align-top border-right-hidden">
				<div>
					<label>
						<?= Html::input('checkbox', '', '', ['checked' => $model->civil_status == 'Single']) ?>
						Single
					</label>
				</div>
				<div>
					<label>
						<?= Html::input('checkbox', '', '', ['checked' => $model->civil_status == 'Widowed']) ?>
						Widowed
					</label>
				</div>
			</td>
			<td class="vertical-align-top">
				<div>
					<label>
						<?= Html::input('checkbox', '', '', ['checked' => $model->civil_status == 'Married']) ?>
						Married
					</label>
				</div>
				<div>
					<label>
						<?= Html::input('checkbox', '', '', ['checked' => $model->civil_status == 'Separated']) ?>
						Separated
					</label>
				</div>
			</td>
			<td rowspan="3" class="vertical-align-top border-bottom-hidden bg-light-gray">
				17. RESIDENTIAL ADDRESS
			</td>
			<td colspan="5">
				<div class="d-flex justify-content-around">
					<div><?= $model->theValue('ra_house_block_lot_no') ?></div>
					<div><?= $model->theValue('ra_street') ?></div>
				</div>
				<hr class="m-0">
				<div class="d-flex justify-content-around line-height-md">
					<div><em><small>House/Block/Lot No</small></em></div>
					<div><em><small>Street</small></em></div>
				</div>
			</td>
		</tr>

		<tr>
			<td colspan="2" class="border-top-hidden vertical-align-top">
				<label>
					<?= Html::input('checkbox', '', '', ['checked' => $model->isOtherCivilStatus]) ?>
					Other/s: <?= $model->otherCivilStatus ?>
				</label>
			</td>
			<td colspan="5">
				<div class="d-flex justify-content-around">
					<div><?= $model->theValue('ra_subdivision_village') ?></div>
					<div><?= $model->theValue('ra_barangay') ?></div>
				</div>
				<hr class="m-0">
				<div class="d-flex justify-content-around line-height-md">
					<div><em><small>Subdivision/Village</small></em></div>
					<div><em><small>Barangay</small></em></div>
				</div>
			</td>
		</tr>
		<tr class="row-height">
			<td class="bg-light-gray">7. HEIGHT (m)</td>
			<td colspan="2">
				<?= $model->theValue('height') ?>
			</td>
			<td colspan="5" class="line-height-md">
				<div class="d-flex justify-content-around">
					<div><?= $model->theValue('ra_city_municipality') ?></div>
					<div><?= $model->theValue('ra_province') ?></div>
				</div>
				<hr class="m-0">
				<div class="d-flex justify-content-around">
					<div><em><small>City/Municipality</small></em></div>
					<div><em><small>Province</small></em></div>
				</div>
			</td>
		</tr>
		<tr class="row-height">
			<td class="bg-light-gray"> 8. WEIGHT (kg) </td>
			<td colspan="2">
				<?= $model->theValue('weight') ?>
			</td>
			<td class="text-center bg-light-gray"> ZIP CODE </td>
			<td colspan="5">
				<?= $model->theValue('ra_zip_code') ?>
			</td>
		</tr>

		<tr class="row-height">
			<td class="bg-light-gray">9. BLOOD TYPE</td>
			<td colspan="2"><?= $model->theValue('blood_type') ?></td>
			<td class="vertical-align-top border-bottom-hidden bg-light-gray">18. PERMANENT ADDRESS</td>
			<td colspan="5">
				<div class="d-flex justify-content-around">
					<div><?= $model->theValue('pa_house_block_lot_no') ?></div>
					<div><?= $model->theValue('pa_street') ?></div>
				</div>
				<hr class="m-0">
				<div class="d-flex justify-content-around line-height-md">
					<div><em><small>House/Block/Lot No</small></em></div>
					<div><em><small>Street</small></em></div>
				</div>
			</td>
		</tr>

		<tr class="row-height">
			<td class="bg-light-gray">10. GSIS ID NO.</td>
			<td colspan="2"><?= $model->theValue('gsis_id_no') ?></td>
			<td class="border-bottom-hidden bg-light-gray"></td>
			<td colspan="5">
				<div class="d-flex justify-content-around">
					<div><?= $model->theValue('pa_subdivision_village') ?></div>
					<div><?= $model->theValue('pa_barangay') ?></div>
				</div>
				<hr class="m-0">
				<div class="d-flex justify-content-around line-height-md">
					<div><em><small>Subdivision/Village</small></em></div>
					<div><em><small>Barangay</small></em></div>
				</div>
			</td>
		</tr>

		<tr class="row-height">
			<td class="bg-light-gray">11. PAG-IBIG ID NO</td>
			<td colspan="2"><?= $model->theValue('pagibig_id_no') ?></td>
			<td class="bg-light-gray"></td>
			<td colspan="5">
				<div class="d-flex justify-content-around">
					<div><?= $model->theValue('pa_city_municipality') ?></div>
					<div><?= $model->theValue('pa_province') ?></div>
				</div>
				<hr class="m-0">
				<div class="d-flex justify-content-around line-height-md">
					<div><em><small>City/Municipality</small></em></div>
					<div><em><small>Province</small></em></div>
				</div>
			</td>
		</tr>

		<tr class="row-height">
			<td class="bg-light-gray">12. PHILHEALTH NO.</td>
			<td colspan="2"><?= $model->theValue('philhealth_no') ?></td>
			<td class="text-center border-top-hidden bg-light-gray">
				ZIP CODE 
			</td>
			<td colspan="5">
				<?= $model->theValue('pa_zip_code') ?>
			</td>
		</tr>

		<tr class="row-height">
			<td class="bg-light-gray">13. SSS NO.</td>
			<td colspan="2"><?= $model->theValue('sss_no') ?></td>
			<td class="bg-light-gray">19. TELEPHONE NO.</td>
			<td colspan="5"> <?= $model->theValue('telephone_no') ?> </td>
		</tr>

		<tr class="row-height">
			<td class="bg-light-gray">14. TIN NO</td>
			<td colspan="2"><?= $model->theValue('tin_no') ?> </td>
			<td class="bg-light-gray">20. MOBILE NO</td>
			<td colspan="5"> <?= $model->theValue('mobile_no') ?></td>
		</tr>

		<tr class="row-height">
			<td class="bg-light-gray">15. AGENCY EMPLOYEE NO.</td>
			<td colspan="2"><?= $model->theValue('agency_employee_no') ?></td>
			<td class="bg-light-gray">21. E-MAIL ADDRESS <small>(if any)</small></td>
			<td colspan="5"> <?= $model->theValue('email_address') ?> </td>
		</tr>
	</tbody>
</table>