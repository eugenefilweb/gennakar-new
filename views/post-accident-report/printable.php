<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\widgets\OpenLayer;

$this->title = 'Post Accident Report: ' . $model->mainAttribute;
$this->params['sleep'] = 2000; 
$this->params['withHeader'] = false;

$this->registerCss(<<< CSS
	#printable {width: 100%; color: #000; font-size: 12pt; height: 100%;}
	#printable tr, #printable td {border: 1px solid;}
	#printable td {padding: 0.4rem;}
	#printable .p-flex {display: flex;}
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
	#printable .p-vat {vertical-align: top;}
	#printable .p-text-right {text-align: right;}
	#printable .p-ml0p4 {margin: auto 0.4rem;}
	#printable .p-lh1p5 {line-height: 1.5rem;}
	#printable input[type="radio"] {pointer-events: none;}
	#printable .border-0 {border: none;}
CSS);

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
								<td class="p-text-center">
									<span class="p-fw-600 p-fs-2rem">
										MDRRMO
									</span>
								</td>
								<td width="20%" class="p-text-center p-color-white p-bg-black p-bc-black p-fw600">
									<span>Control No</span>
								</td>
							</tr>
							<tr>
								<td class="p-text-center p-header p-color-black p-bg-red">
									<span class="p-fw-600 p-fs-2rem">RESCUE/ POST ACCIDENT REPORT</span>
								</td>
								<td class="p-text-center">
									<span class="p-fw-600">
										<?= $model->control_no ?>
									</span>
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
								<td width="25%" class="p-color-white p-bg-black p-bc-black">
									<span class="p-fw500">
										Location of Accident/Rescue
									</span>
								</td>
								<td class="p-bbh">
									<?= $model->location ?>
								</td>
							</tr>
						</tbody>
					</table>

					<table width="100%">
						<tbody>
							<tr>
								<td colspan="2" rowspan="2" width="40%" class="p-text-center p-bg-black p-color-white p-blcb p-bbcb">
									<span class="p-fs1p8 p-fw600">Type of Accident</span>
								</td>
								<td rowspan="2" width="20%" class="p-text-center p-bg-black p-color-white p-vab p-bbcb">
									<span class="p-fw600 p-fs1p5">TOTAL</span>
								</td>
								<td width="10%" class="p-text-center p-bg-black p-color-white p-bbcb">
									<span class="p-fw600">M</span>
								</td>
								<td width="10%" class="p-text-center p-bg-black p-color-white p-bbcb">
									<span class="p-fw600">F</span>
								</td>
								<td colspan="2" width="20%" class="p-text-center p-bg-black p-color-white p-bbcb p-brcb">
									<span class="p-fw600">MAP</span>
								</td>
							</tr>
							<tr>
								<td class="p-text-center">
									<span>
										<?= number_format($model->totalMale) ?>
									</span>
								</td>
								<td class="p-text-center">
									<span>
										<?= number_format($model->totalFemale) ?>
									</span>
								</td>
								<td rowspan="4" colspan="2" class="p-text-center">
									<img src="<?= Url::image($model->map, ['w' => 200]) ?>">
								</td>
							</tr>
						
							<tr>
								<td>
									<div class="p-flex p-lh1p5">
										<div>
											<?= Html::input('radio', 'type_of_accident', 'Emergency Medical', [
												'checked' => trim($model->type_of_accident) == 'Emergency Medical'
											]) ?>
										</div>
										<div class="p-ml0p4">
											Emergency Medical
										</div>
									</div>
								</td>
								<td>
									<div class="p-flex p-lh1p5">
										<div>
											<?= Html::input('radio', 'type_of_accident', 'Vehicular', [
												'checked' => trim($model->type_of_accident) == 'Vehicular'
											]) ?>
										</div>
										<div class="p-ml0p4">
											Vehicular
										</div>
									</div>
								</td>
								<td class="p-text-center">
									<span class="p-fw-600">Participants</span>
								</td>
								<td class="p-text-center">
									<span>
										<?= number_format($model->participant_male) ?>
									</span>
								</td>
								<td class="p-text-center">
									<span>
										<?= number_format($model->participant_female) ?>
									</span>
								</td>
							</tr>
							<tr>
								<td>
									<div class="p-flex p-lh1p5">
										<div>
											<?= Html::input('radio', 'type_of_accident', 'Water Search and Rescue', [
												'checked' => trim($model->type_of_accident) == 'Water Search and Rescue'
											]) ?>
										</div>
										<div class="p-ml0p4">
											Water Search and Rescue
										</div>
									</div>
								</td>
								<td>
									<div class="p-flex p-lh1p5">
										<div>
											<?= Html::input('radio', 'type_of_accident', 'Mountain Search and Rescue', [
												'checked' => trim($model->type_of_accident) == 'Mountain Search and Rescue'
											]) ?>
										</div>
										<div class="p-ml0p4">
											Mountain Search and Rescue
										</div>
									</div>
								</td>
								<td class="p-text-center">
									<div class="p-fw-600 p-lh1p5">Local Government Responders</div>
								</td>
								<td class="p-text-center">
									<span>
										<?= number_format($model->local_male) ?>
									</span>
								</td>
								<td class="p-text-center">
									<span>
										<?= number_format($model->local_female) ?>
									</span>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="p-flex p-lh1p5">
										<div>
											<?= Html::input('radio', 'type_of_accident', 'Disaster (Earthquake, Flood, Tsunami Fire)', [
												'checked' => trim($model->type_of_accident) == 'Disaster (Earthquake, Flood, Tsunami Fire)'
											]) ?>
										</div>
										<div class="p-ml0p4">
											Disaster (Earthquake, Flood, Tsunami Fire)
										</div>
									</div>
								</td>
								<td class="p-text-center">
									<div class="p-fw-600 p-lh1p5">
										National Government Responders
									</div>
								</td>
								<td class="p-text-center">
									<span>
										<?= number_format($model->national_male) ?>
									</span>
								</td>
								<td class="p-text-center">
									<span>
										<?= number_format($model->national_female) ?>
									</span>
								</td>
							</tr>

							<tr>
								<td colspan="2">
									<div class="p-flex p-lh1p5">
										<div>
											<?= Html::input('radio', 'type_of_accident', 'Others (Specify Accident)', [
												'checked' => $model->otherTypeOfAccident ? true: false
											]) ?>
										</div>
										<div class="p-ml0p4">
											Others (Specify Accident)
										</div>
									</div>
									<div class="p-underline p-lh1p5">
										<?= $model->otherTypeOfAccident ?>
									</div>
								</td>
								<td>
									<span class="p-fw-600">Others (Specify):</span> 
									<div class="p-underline p-lh1p5">
										<?= $model->other_name ?>
									</div>
								</td>
								<td class="p-text-center">
									<span>
										<?= number_format($model->other_male) ?>
									</span>
								</td>
								<td class="p-text-center">
									<span>
										<?= number_format($model->other_female) ?>
									</span>
								</td>
								<td class="p-text-center">
									<span>Barangay</span>
								</td>
								<td class="p-text-center">
									<span>
										<?= $model->barangay ?>
									</span>
								</td>
							</tr>
						</tbody>
					</table>

					<div class="p-h1p2rem"></div>

					<table width="100%">
						<tbody>
							<tr>
								<td width="33.33%" class="p-fw600 p-bg-black p-color-white p-text-center p-btcb p-bbcb p-blcb">
									<span> Accident Time </span>
								</td>
								<td width="33.33%" class="p-fw600 p-bg-black p-color-white p-text-center p-btcb p-bbcb">
									<span> Accident Date </span>
								</td>
								<td width="33.33%" class="p-fw600 p-bg-black p-color-white p-text-center p-btcb p-bbcb p-brcb">
									<span> Weather Condition</span>
								</td>
							</tr>
							<tr>
								<td class="p-text-center">
									<span>
										<?= $model->time ?>
									</span>
								</td>
								<td class="p-text-center">
									<span>
										<?= $model->date ?>
									</span>
								</td>
								<td class="p-text-center">
									<span>
										<?= $model->weather_condition ?>
									</span>
								</td>
							</tr>
						</tbody>
					</table>

					<div class="p-h1p2rem"></div>

					<table width="100%">
						<tbody>
							<tr>
								<td width="33.33%" class="p-fw600 p-bg-black p-color-white p-text-center p-btcb p-bbcb p-blcb">
									<span> Rescuee(s)/Person(s)-of-Interest  </span>
								</td>
								<td width="33.33%" class="p-fw600 p-bg-black p-color-white p-text-center p-btcb p-bbcb">
									<span> Responder(s) </span>
								</td>
								<td width="33.33%" class="p-fw600 p-bg-black p-color-white p-text-center p-btcb p-bbcb p-brcb">
									<span> Witnesses/Other(s)</span>
								</td>
							</tr>

							<tr class="p-h10rem">
								<td class="p-text-center p-vat">
									<?= Html::foreach($model->persons_of_interest, function($value) {
										return Html::tag('div', $value);
									}) ?>
								</td>
								<td class="p-text-center p-vat">
									<?= Html::foreach($model->responders, function($value) {
										return Html::tag('div', $value);
									}) ?>
								</td>
								<td class="p-text-center p-vat">
									<?= Html::foreach($model->witnesses, function($value) {
										return Html::tag('div', $value);
									}) ?>
								</td>
							</tr>
						</tbody>
					</table>

					<div class="p-h1p2rem"></div>

					<table width="100%">
						<tbody>
							<tr>
								<td width="100%" colspan="2" class="p-fw600 p-bg-black p-color-white p-text-center p-btcb p-bbcb p-blcb p-brcb">
									<span> ACCIDENT REPORT/RESCUE PERFORMED  </span>
								</td>
							</tr>
							<tr class="p-h35rem">
								<td colspan="2" class="p-vat">
									<span>
										<?= $model->accident_report ?>
									</span>
								</td>
							</tr>
							<tr>
								<td width="50%">
									<span>Age:</span>
									<span>
										<?= $model->age ?>
									</span>
								</td>
								<td width="50%">
									<span>Sex:</span>
									<span>
										<?= $model->sexLabel ?>
									</span>
								</td>
							</tr>
							<tr>
								<td width="50%">
									<span>Prepared by:</span>
									<span>
										<?= $model->prepared_by ?>
									</span>
								</td>
								<td width="50%">
									<span>Verified by:</span>
									<span>
										<?= $model->verified_by ?>
									</span>
								</td>
							</tr>
						</tbody>
					</table>

					<div class="p-h1p2rem"></div>
					<table width="100%">
						<tbody>
							<tr>
								<td width="100%" colspan="3" class="p-fw600 p-bg-black p-color-white p-text-center p-btcb p-bbcb p-blcb p-brcb">
									<span> COMMENTS/REMARKS  </span>
								</td>
							</tr>
							<tr class="p-h12rem">
								<td colspan="3" class="p-vat">
									<span>
										<?= $model->remarks ?>
									</span>
								</td>
							</tr>
							<tr>
								<td width="33.33%">
									<span>Comments by: </span>
									<div>
										<?= $model->comments_by ?>
									</div>
								</td>
								<td width="33.33%">
									<span>Responder Team Lead/Officer Incharge:</span>
									<div>
										<?= $model->officer_in_charge ?>
									</div>
								</td>
								<td width="33.33%">
									<span>Noted by:</span>
									<div>
										<?= $model->noted_by ?>
									</div>
								</td>
							</tr>
						</tbody>
					</table>

					<table width="100%">
						<tbody>
							<tr>
								<td class="p-bh">
									<span>
										<?= $model->code ?>
									</span>
								</td>
								<td class="p-bh p-text-right">
									<span>Date Generated: <?= $model->generatedDate ?></span>
								</td>
							</tr>
						</tbody>
					</table>
					
					<div style="break-after:always"></div>
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