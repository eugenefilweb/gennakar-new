<?php

use app\helpers\App;
use app\helpers\Html;
?>

<table border="1">
	<tbody>
		<tr class="bg-light-gray row-height">
			<td colspan="4" class="border-top-hidden border-left-hidden">
				41. REFERENCES 
				<small class="text-danger">
					<b>
						(Person not related by consanguinity or affinity to applicant /appointee)
					</b>
				</small>
			</td>
		</tr>
		<tr class="bg-light-gray row-height">
			<td class="border-left-hidden text-center" width="50%" colspan="2">NAME</td>
			<td class="text-center" width="35%">ADDRESS</td>
			<td class="text-center" width="15%">TEL. NO</td>
		</tr>

		<?= App::foreach($model->references, fn ($reference, $index, $counter) => $counter > 3 ? '': Html::tag('tr', implode('', [
			Html::tag('td', $reference['name'], [
				'class' => 'text-center border-left-hidden',
				'colspan' => 2
			]),
			Html::tag('td', $reference['address'], ['class' => 'text-center']),
			Html::tag('td', $reference['tel_no'], ['class' => 'text-center']),
		]), ['class' => 'row-height line-height-sm'])) ?>

		<?= App::for(3 - count($model->references), fn ($i) => <<< HTML
			<tr class="row-height">
				<td class="border-left-hidden" colspan="2"></td>
				<td></td>
				<td></td>
			</tr>
		HTML ) ?>

		<tr class="bg-light-gray">
			<td width="3%" class="vertical-align-top border-right-hidden border-left-hidden"> 42. </td>
			<td colspan="3">
				 I declare under oath that I have personally accomplished this Personal Data Sheet which is a true, correct and complete statement pursuant to the provisions of pertinent laws, rules and regulations of the Republic of the Philippines. I authorize the agency head/authorized representative to verify/validate the contents stated herein. I agree that any misrepresentation made in this document and its attachments shall cause the filing of administrative/criminal case/s against me.
			</td>
		</tr>

		<tr>
			<td colspan="4" class="border-left-hidden border-right-hidden pr-0 border-bottom-hidden">
				<table>
					<tbody>
						<td width="50%" class="p-5">
							<table border="1">
								<tbody>
									<tr>
										<td class="bg-light-gray font-size-sm">
											Government Issued ID
											<small>
												<em>(i.e.Passport, GSIS, SSS, PRC, Driver's License, etc.) </em>
											</small>
											<div>
												<em>PLEASE INDICATE ID Number and Date of Issuance</em>
											</div>
										</td>
									</tr>
									<tr class="row-height font-size-sm">
										<td>Government Issued ID: <?= $model->theValue('government_issued_id') ?></td>
									</tr>
									<tr class="row-height font-size-sm">
										<td>ID/License/Passport No.: <?= $model->theValue('government_id_no') ?></td>
									</tr>
									<tr class="row-height font-size-sm">
										<td>Date/Place of Issuance: <?= $model->theValue('government_id_place_of_issuance') ?></td>
									</tr>
								</tbody>
							</table>
						</td>
						<td class="pr-0 border-right-hidden">
							<table border="1">
								<tbody>
									<tr>
										<td class="text-center">
											<img src="<?= $model->signature ?>" class="img-fluid signature-bottom">
										</td>
									</tr>
									<tr>
										<td class="bg-light-gray text-center font-size-sm">Signature (Sign inside the box)</td>
									</tr>
									<tr>
										<td class="text-center">
											<?= date('m/d/Y', strtotime($model->created_at)) ?>
										</td>
									</tr>

									<tr>
										<td class="bg-light-gray text-center font-size-sm">Date Accomplished</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>