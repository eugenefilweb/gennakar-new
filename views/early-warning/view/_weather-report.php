<?php

use app\helpers\App;
use app\helpers\Html;

$address = App::setting('address');
$personnel = App::setting('personnel');
$profile = App::identity('profile');
?>
<div class="weather-report" style="line-height: 2rem;">
	<p>
		Mayor <?= $personnel->mayorName ?>
		<br>Office of the Municipal Mayor
		<br><?= $address->blk_lot_street ?>
		<br> <?= ucwords(strtolower($address->municipalityName)) ?>, <?= ucwords(strtolower($address->provinceName)) ?>, <?= $address->zip ?>
	</p>
	<p></p>
	<p>Subject: <?= $model->subject ?></p>

	<p>Dear Mayor <?= $personnel->mayor_lastname ?>,</p>

	<p style="text-align: justify;text-indent: 50px;"><?= $model->entry_text ?>,</p>

	<p>Please find the summary of the Severe Weather Bulletin below:</p>
	<p>Severe Weather Bulletin</p>

	<p>
		Bulletin Number: <?= $model->bulletin_no ?>
		<br>Storm Signal Warning: Signal No. <?= $model->signal_no ?>
		<br>Category: <?= $model->category ?>
		<br>Wind speed: <?= $model->windspeed ?>
	</p>

	<p style="text-align: justify;"> Meteorological Conditions: <?= $model->meteorological_conditions ?> </p>
	<p style="text-align: justify;"> Impact of Winds: <?= $model->impact_of_winds ?> </p>
	<p style="text-align: justify;"> Precautionary Measures: <?= $model->precautionary_measures ?> </p>

	<?= App::if($model->attachment_text, fn ($text) => Html::tag('p', $text, ['style' => 'text-indent: 50px'])) ?>
	<?= App::if($model->other_text, fn ($text) => Html::tag('p', $text, ['style' => 'text-indent: 50px'])) ?>

	<p></p>
	<p>Sincerely,</p>
	<p>
		<?= $profile->fullname ?>
		<br><?= $profile->position ?>
		<br><?= $profile->department ?>
		<br><?= $profile->contact ?>
	</p>

	<div class="page-break mce-pagebreak"></div>
	<?= App::if($model->attachmentFiles, function ($files) {
		$attachments = implode('<tr style="border-right:hidden; border-left:hidden"><td></td></tr>', App::foreach($files, function($file) {
			$img = Html::image($file, [], ['class' => 'img-fluid', 'style' => 'max-width: 100%; height: auto;']);
			return <<< HTML
				<tr class="page-break-before-avoid">
					<td>
						<div style="text-align: center"><b>{$file->nameWithExtension}</b></div>
						<div>{$img}</div> 
					</td>
				</tr>
			HTML;
		}, false));

		return <<< HTML
			<p>Attachments:</p>
			<table style="width:100%; height: auto" border="1">
				<tbody>
					{$attachments}
				</tbody>
			</table>
		HTML;
	}) ?>

	
</div>