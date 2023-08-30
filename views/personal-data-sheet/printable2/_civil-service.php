<?php

use app\helpers\App;
use app\helpers\Html;
?>

<table border="1">
	<tbody>
		<tr>
			<td class="border-hidden" width="33.33%"></td>
			<td class="border-hidden" width="10%"></td>
			<td class="border-hidden" width="10%"></td>
			<td class="border-hidden" width="30%"></td>
			<td class="border-hidden" width="9%"></td>
			<td class="border-hidden"></td>
		</tr>

		<tr>
			<td colspan="6" class="font-size-1_1rem bg-gray text-white">
				<em>
					<b>IV. CIVIL SERVICE ELIGIBILITY</b>
				</em>
			</td>
		</tr>

		<tr class="bg-light-gray">
			<td rowspan="2">
				<div class="d-flex align-items-baseline">
					<div class="pt-0 nowrap">27.</div>
					<div class="text-center line-height-sm">CAREER SERVICE/ RA 1080 (BOARD/ BAR) UNDER SPECIAL LAWS/ CES/ CSEE BARANGAY ELIGIBILITY / DRIVER'S LICENSE</div>
				</div>
			</td>
			<td rowspan="2" class="text-center line-height-sm">
				<div>RATING </div>
				<div><small>(If Applicable)</small></div>
			</td>
			<td rowspan="2" class="text-center line-height-sm">
				DATE OF EXAMINATION / CONFERMENT
			</td>
			<td rowspan="2" class="text-center line-height-sm">
				PLACE OF EXAMINATION / CONFERMENT
			</td>
			<td colspan="2" class="text-center line-height-sm">
				LICENSE <small class="line-height-sm">(If Applicable)</small>
			</td>
		</tr>
		<tr class="line-height-sm">
			<td class="text-center">NUMBER</td>
			<td class="text-center">Date of Validity </td>
		</tr>

		<?= App::foreach($model->civilServices, fn ($civilService, $index, $counter) => <<< HTML
			<tr class="row-height line-height-sm">
				<td class="text-center">{$counter}-{$civilService->theValue('career_service')}</td>
				<td class="text-center">{$civilService->theValue('rating')}</td>
				<td class="text-center">{$civilService->theValue('date_of_examination')}</td>
				<td class="text-center">{$civilService->theValue('place_of_examination')}</td>
				<td class="text-center">{$civilService->theValue('license')}</td>
				<td class="text-center">{$civilService->theValue('license_date')}</td>
			</tr>
		HTML) ?>

	</tbody>
</table>