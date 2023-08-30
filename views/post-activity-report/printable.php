<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\OpenLayer;

$this->registerCss(<<< CSS
	#printable {width: 100%; color: #000; font-size: 12pt; height: 100%;}
	#printable .p-mllh {margin: auto 0; margin-left: 0.4rem; line-height: 1.5rem;}
	#printable tr, #printable td {border: 1px solid;}
	#printable td {padding: 0.4rem;}
	#printable .p-text-center {text-align: center;}
	#printable .p-fs-2rem {font-size: 2rem;}
	#printable .p-bg-red {background: #e82319;}
	#printable .p-bg-black {background: #000;}
	#printable .p-color-black {color: #000;}
	#printable .p-color-white {color: #fff;}
	#printable .p-bc-black {border-color: #000;}
	#printable .p-fw-600 {font-weight: 600;}
	#printable .p-mb-0 {margin-bottom: 0;}
	#printable .p-underline {text-decoration: underline;}
	#printable .p-bbw {border-bottom-color: #fff;}
	#printable .p-bbh {border-bottom: hidden;}
	#printable .p-fw600 {font-weight: 600;}
	#printable .p-fw500 {font-weight: 500;}
	#printable .p-fs1p5 {font-size: 1.5rem;}
	#printable .p-fs1p8 {font-size: 1.8rem;}
	#printable .p-fs1p3 {font-size: 1.3rem;}
	#printable .p-fs1p2 {font-size: 1.2rem;}
	#printable .p-fs1p1 {font-size: 1rem;}
	#printable .p-vab {vertical-align: bottom;}
	#printable .p-blcb {border-left-color: #000;}
	#printable .p-bbcb {border-bottom-color: #000;}
	#printable .p-brcb {border-right-color: #000;}
	#printable .p-btcb {border-top-color: #000;}
	#printable .p-bh {border: hidden;}
	#printable .p-h2rem {height: 2rem;}
	#printable .p-h1p2rem {height: 1.2rem;}
	#printable .p-h10rem {height: 10rem;}
	#printable .p-h35rem {height: 23rem;}
	#printable .p-h12rem {height: 12rem;}
	#printable .p-vat {vertical-align: top}
	#printable .p-text-right {text-align: right;}
	#printable .p-d-flex {display: flex;}
	#printable .border-0 {border: none;}
CSS);

$typeOfActivities = $model->typeOfActivityList;
$this->params['withHeader'] = false;
$this->params['sleep'] = 2000;

$this->registerJs(<<< JS
    KTApp.block('body', {
        overlayColor: '#000000',
        message: 'Loading map...',
        state: 'primary'
    });
    setTimeout(function() {
        KTApp.unblockPage();
    }, 1000);
JS);
?>

<div id="printable" style="<?= $style ?? '' ?>">
	<table width="100%" class="border-0">
		<thead>
			<tr class="border-0">
				<td class="border-0">
					<table width="100%">
						<tbody>
							<tr>
								<td rowspan="2" width="11%" class="p-text-center">
									<img src="<?= Url::image(App::setting('image')->primary_logo, ['w' => 100]) ?>">
								</td>
								<td class="p-text-center" height="10%">
									<span class="p-fw-600 p-fs-2rem">
										<?= $model->headerLabel ?>
									</span>
								</td>
								<td width="20%" class="p-text-center p-color-white p-bg-black p-bc-black p-fw600">
									<span>Control No</span>
								</td>
							</tr>
							<tr>
								<td class="p-text-center p-header p-color-black p-bg-red">
									<span class="p-fw-600 p-fs-2rem">POST ACTIVITY REPORT</span>
								</td>
								<td class="p-text-center">
									<span class="p-fw-600"><?= $model->control_no ?></span>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</thead>
		<tbody>
			<tr class="border-0">
				<td class="border-0">
					<div class="p-h1p2rem"></div>

					<table width="100%">
						<tbody>
							<tr>
								<td width="30%" class="p-color-white p-bg-black p-bc-black p-bbw">
									<span class="p-fw500">Name of Activity</span>
								</td>

								<td class="p-bc-black"><?= $model->name ?></td>
							</tr>
							<tr>
								<td width="25%" class="p-color-white p-bg-black p-bc-black">
									<span class="p-fw500">
										 Location of Activity
									</span>
								</td>

								<td class="p-bc-black"><?= $model->location ?></td>
							</tr>
						</tbody>
					</table>

					<table width="100%">
						<tbody>
							<tr>
								<td colspan="2" rowspan="3" width="40%" class="p-text-center p-bg-black p-color-white p-blcb p-bbcb">
									<span class="p-fs1p8 p-fw600">Type of Activity</span>
								</td>
								<td colspan="3" width="40%" class="p-text-center p-bg-black p-color-white p-blcb">
									<span class="p-fs1p3 p-fw600">Attendance/Target Beneficiaries</span>
								</td>
								<td colspan="2" rowspan="2" width="20%" class="p-text-center p-bg-black p-color-white p-bbcb p-brcb">
									<span class="p-fw600">MAP</span>
								</td>
							</tr>
							<tr>
								<td rowspan="2" width="20%" class="p-text-center p-bg-black p-color-white p-vab p-bbcb">
									<span class="p-fw600 p-fs1p5">TOTAL</span>
								</td>
								<td width="10%" class="p-text-center p-bg-black p-color-white p-bbcb">
									<span class="p-fw600">M</span>
								</td>
								<td width="10%" class="p-text-center p-bg-black p-color-white p-bbcb">
									<span class="p-fw600">F</span>
								</td>

							</tr>
							<tr>
								<td class="p-text-center">
									<span> <?= number_format($model->sumOfBeneficiaryMale); ?> </span>
								</td>
								<td class="p-text-center">
									<span> <?= number_format($model->sumOfBeneficiaryFemale) ?> </span>
								</td>
								<td rowspan="4" colspan="2" class="p-text-center">
									<img src="<?= Url::image($model->map, ['w' => 200]) ?>">
								</td>
							</tr>
							<tr>
								<td>
									<label class="p-mb-0">
										<div class="p-d-flex">
											<div>
												<input type="radio" name="type_of_accident" <?= $model->type_of_activity == $typeOfActivities[0] ? "checked" : "disabled" ?>>
											</div>
											<div class="p-mllh"> <?= $typeOfActivities[0] ?> </div>
										</div>
									</label>
								</td>
								<td>
									<label class="p-mb-0">
										<div class="p-d-flex">
											<div>
												<input type="radio" name="type_of_accident" <?= $model->type_of_activity == $typeOfActivities[1] ? "checked" : "disabled" ?>>
											</div>
											<div class="p-mllh"> <?= $typeOfActivities[1] ?> </div>
										</div>
									</label>
								</td>
								<td class="p-text-center">
									<span class="p-fw-600">Beneficiaries/Stakeholders</span>
								</td>
								<td class="p-text-center">
									<span> <?= number_format($model->beneficiary_stakeholder_male) ?> </span>
								</td>
								<td class="p-text-center">
									<span> <?= number_format($model->beneficiary_stakeholder_female) ?> </span>
								</td>
							</tr>
							<tr>
								<td>
									<label class="p-mb-0">
										<div class="p-d-flex">
											<div>
												<input type="radio" name="type_of_accident" <?= $model->type_of_activity == $typeOfActivities[2] ? "checked" : "disabled" ?>>
											</div>
											<div class=" p-mllh"> <?= $typeOfActivities[2] ?> </div>
										</div>

									</label>
								</td>
								<td>
									<label class="p-mb-0">
										<div class="p-d-flex">
											<div>
												<input type="radio" name="type_of_accident" <?= $model->type_of_activity == $typeOfActivities[3] ? "checked" : "disabled" ?>>
											</div>
											<div class="p-mllh"> <?= $typeOfActivities[3] ?> </div>
										</div>
									</label>
								</td>
								<td class="p-text-center">
									<span class="p-fw-600">Local Government</span>
								</td>
								<td class="p-text-center">
									<span><?= number_format($model->beneficiary_local_male) ?></span>
								</td>
								<td class="p-text-center">
									<span><?= number_format($model->beneficiary_local_female) ?></span>
								</td>
							</tr>
							<tr>
								<td>
									<label class="p-mb-0">
										<div class="p-d-flex">
											<div>
												<input type="radio" name="type_of_accident" <?= $model->type_of_activity == $typeOfActivities[4] ? "checked" : "disabled" ?>>
											</div>
											<div class="p-mllh"> <?= $typeOfActivities[4] ?> </div>
										</div>
									</label>
								</td>
								<td>
									<label class="p-mb-0">
										<div class="p-d-flex">
											<div>
												<input type="radio" name="type_of_accident" <?= $model->type_of_activity == $typeOfActivities[5] ? "checked" : "disabled" ?>>
											</div>
											<div class=" p-mllh"> <?= $typeOfActivities[5] ?> </div>
										</div>
									</label>
								</td>
								<td class="p-text-center">
									<span class="p-fw-600">National Government</span>
								</td>
								<td class="p-text-center">
									<span> <?= number_format($model->beneficiary_national_male) ?> </span>
								</td>
								<td class="p-text-center">
									<span> <?= number_format($model->beneficiary_national_female) ?> </span>
								</td>
							</tr>

							<tr>
								<td colspan="2">
									<div class="p-d-flex">
										<div>
											<input type="radio" name="type_of_accident" value="" <?= !in_array($model->type_of_activity, $typeOfActivities) ? " checked" : "disabled" ?>>
										</div>
										<div class="p-mllh">
											<span>Others (Specify Activity Title)</span> <br>
											<span class="p-underline p-mllh">
												<?php if(!in_array($model->type_of_activity, $typeOfActivities)){ ?>
													<?= $model->type_of_activity ?>
												<?php } ?>
											</span>
										</div>
									</div>
								</td>
								<td>
									<div class="p-d-flex">
										<span class="p-fw-600">Others (Specify):</span> <br>
										<div class="p-mllh">
											<span class="p-underline"><?= $model->beneficiary_other_name ?></span>
										</div>
									</div>
								</td>
								<td class="p-text-center">
									<span> <?= number_format($model->beneficiary_other_male) ?> </span>
								</td>
								<td class="p-text-center">
									<span> <?= number_format($model->beneficiary_other_female) ?> </span>
								</td>
								<td class="p-text-center">
									<span><?= $model->isSiad ? 'Watershed': 'Barangay' ?></span>
								</td>
								<td class="p-text-center"> 
									<?= $model->isSiad ? $model->watershedName: $model->barangayName ?> 
								</td>
							</tr>
						</tbody>
					</table>

					<div class="p-h1p2rem"></div>

					<table width="100%">
						<tbody>
							<tr>
								<td width="20%" class="p-fw600 p-bg-black p-color-white p-text-center p-btcb p-bbcb p-blcb">
									<span> Date Started </span>
								</td>
								<td width="20%" class="p-fw600 p-bg-black p-color-white p-text-center p-btcb p-bbcb">
									<span> Date Ended </span>
								</td>
								<td width="20%" class="p-fw600 p-bg-black p-color-white p-text-center p-btcb p-bbcb p-brcb">
									<span> Time Started</span>
								</td>
								<td width="20%" class="p-fw600 p-bg-black p-color-white p-text-center p-btcb p-bbcb p-brcb">
									<span> Time Ended</span>
								</td>
							</tr>

							<tr>
								<td class="p-text-center">
									<span> <?= date('m/d/y', strtotime($model->date_started)) ?> </span>
								</td>
								<td class="p-text-center">
									<span> <?= date('m/d/y', strtotime($model->date_end)) ?> </span>
								</td>
								<td class="p-text-center">
									<span> <?= date('g:i A', strtotime($model->date_started)) ?> </span>
								</td>
								<td class="p-text-center">
									<span> <?= date('g:i A', strtotime($model->date_end))  ?> </span>
								</td>
							</tr>
						</tbody>
					</table>

					<div class="p-h1p2rem"></div>

					<table width="100%">
						<tbody>
							<tr>
								<td width="20%" class="p-fw600 p-bg-black p-color-white p-text-center p-btcb p-bbcb p-blcb">
									<span> Responsible Head </span>
								</td>
								<td width="14%" class="p-fw600 p-bg-black p-color-white p-text-center p-btcb p-bbcb">
									<span> Coordinator/Facilitator(s) </span>
								</td>
								<td width="20%" class="p-fw600 p-bg-black p-color-white p-text-center p-btcb p-bbcb p-brcb">
									<span> Staff Member(s) )</span>
								</td>
								<td width="20%" class="p-fw600 p-bg-black p-color-white p-text-center p-btcb p-bbcb p-brcb">
									<span> Other(s)) </span>
								</td>
							</tr>

							<tr class="p-h10rem">
								<td class="p-text-center p-vat">
									<span> <?= $model->responsible_head ?> </span>
								</td>
								<td class="p-text-center p-vat">
									<span>
										<?php foreach ($model->coordinators as $coordinator): ?>
											<div><?= $coordinator['name'] ?? '' ?>: <?= $coordinator['office'] ?? '' ?></div>
										<?php endforeach ?>
									</span>
								</td>
								<td class="p-text-center p-vat">
									<span>
										<?php foreach ($model->staff_members as $staff_member): ?>
											<div><?= $staff_member ?></div>
										<?php endforeach ?>
									</span>
								</td>
								<td class="p-text-center p-vat">
									<span>
										<?php foreach ($model->other_members as $other_member): ?>
											<div><?= $other_member ?></div>
										<?php endforeach ?>
									</span>
								</td>
							</tr>
						</tbody>
					</table>

					<div class="p-h1p2rem"></div>

					<table width="100%">
						<tbody>
							<tr>
								<td colspan="2" class="p-fw600 p-bg-black p-color-white p-text-center p-btcb p-bbcb p-blcb">
									<span>ACTIVITY BRIEF</span>
								</td>
							</tr>
							<tr class="p-h35rem">
								<td colspan="2" class="p-vat">
									<span><?= $model->activity_brief ?></span>
								</td>
							</tr>
							<tr>
								<td width="50%">
									<span>Prepared by:</span>
									<span><?= $model->prepared_by ?></span>
								</td>
								<td width="50%">
									<span>Verified by:</span>
									<span><?= $model->verified_by ?></span>
								</td>
							</tr>
						</tbody>
					</table>

					<div class="p-h1p2rem"></div>
					<table width="100%">
						<tbody>
							<tr>
								<td width="100%" colspan="3" class="p-fw600 p-bg-black p-color-white p-text-center p-btcb p-bbcb p-blcb">
									<span> COMMENTS/REMARKS </span>
								</td>
							</tr>
							<tr class="p-h12rem">
								<td colspan="3" class="p-vat">
									<span> <?= $model->remarks ?> </span>
								</td>
							</tr>
							<tr>
								<td width="33.33%">
									<span>Comments by: </span>
									<div> <?= $model->comments_by ?> </div>
								</td>
								<td width="33.33%">
									<span>In-charge of Activity:</span>
									<div> <?= $model->in_charge_of_activity ?> </div>
								</td>
								<td width="33.33%">
									<span>Noted by:</span>
									<div> <?= $model->noted_by ?> </div>
								</td>
							</tr>
						</tbody>
					</table>

					<table width="100%">
						<tbody>
							<tr>
								<td class="p-bh"><span><?= $model->code ?></span></td>
								<td class="p-bh p-text-right">
									<span>Date Generated: <?= $model->getDateTimeZone() ?></span>
								</td>
							</tr>
						</tbody>
					</table>

					<div style='break-after:always'></div>
					<div class="d-flex justify-content-between">
						<div class="pr-2 pb-2 pt-5 pl-0">
							<?= App::if($model->photo1, fn ($token) => Html::image($token, ['w' => 500], [
								'class' => 'img-fluid img-thumbnail',
								'style' => 'height: 500px'
							])) ?>
						</div>
						<div class="pr-0 pb-2 pt-5 pl-2">
							<?= App::if($model->photo2, fn ($token) => Html::image($token, ['w' => 500], [
								'class' => 'img-fluid img-thumbnail',
								'style' => 'height: 500px'
							])) ?>
						</div>
					</div>

					<div class="d-flex justify-content-between">
						<div class="pr-2 pb-2 pt-2 pl-0">
							<?= App::if($model->photo3, fn ($token) => Html::image($token, ['w' => 500], [
								'class' => 'img-fluid img-thumbnail',
								'style' => 'height: 500px'
							])) ?>
						</div>
						<div class="pr-0 pb-2 pt-2 pl-2">
							<?= App::if($model->photo4, fn ($token) => Html::image($token, ['w' => 500], [
								'class' => 'img-fluid img-thumbnail',
								'style' => 'height: 500px'
							])) ?>
						</div>
					</div>

					<div class="page-break"> </div>
					<?= OpenLayer::widget([
						'zoom' => 16,
				        'latitude' => $model->latitude,
				        'longitude' => $model->longitude,
                        'withSearch' => false
				    ]) ?>
				</td>
			</tr>
		</tbody>
	</table>
</div>