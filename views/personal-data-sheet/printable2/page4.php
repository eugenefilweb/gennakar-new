<?php

use app\helpers\App;
use app\helpers\Html;
?>

<?= $this->render('_questionnaire', ['model' => $model]) ?>

<table border="1">
	<tbody>
		<tr class="border-top-hidden">
			<td colspan="3" class="p-0 vertical-align-top border-right-hidden">
				<?= $this->render('_reference', ['model' => $model]) ?>
			</td>
			<td width="20%" class="px-5 pt-5 pb-2 text-center pb-0">

				<table border="1" style="max-width: 3.5cm; margin: 0 auto;">
					<tbody>
						<tr>
							<td>
								<?= Html::image($model->photo, [], [
									'class' => 'p-1',
									'style' => 'width: 3.5cm !important; height: 4.5cm; '
								]) ?>
							</td>
						</tr>
						<tr>
							<td class="border-bottom-hidden border-left-hidden border-right-hidden">
								<div class="text-dark-50 my-2 font-size-sm">PHOTO</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="my-1">
					<table border="1">
						<tbody>
							<tr>
								<td>
									<?= Html::image($model->right_thumbmark, [], [
										'class' => 'p-1',
										'style' => 'width: 4.5cm !important; height: 126px; '
									]) ?>
								</td>
							</tr>
							<tr class="bg-light-gray">
								<td class="font-size-sm">Right Thumbmark</td>
							</tr>
						</tbody>
					</table>
				</div>
			</td>
		</tr>

		<tr class="row-height">
			<td colspan="4" class="text-center border-bottom-hidden">
				<div class="my-3">
					SUBSCRIBED AND SWORN to before me this <span class="text-underline"> <?= $model->dateFormat('jS') ?> of <?= $model->dateFormat('F') ?> year <?= $model->dateFormat('Y') ?></span>, affiant exhibiting his/her validly issued government ID as indicated above.
				</div> 
			</td>
		</tr>
		<tr>
			<td colspan="2" width="38%" class="border-right-hidden"></td>
			<td class="border-right-hidden pb-6">
				<table border="1">
					<tbody>
						<tr class="h-64px">
							<td class="text-center">
								<?= $model->theValue('person_administering_oath') ?>
							</td>
						</tr>
						<tr>
							<td class="bg-light-gray text-center">
								Person Administering Oath
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>


		<tfoot class="border-bottom-hidden">
			<tr>
				<td colspan="4" class="text-right border-right-hidden border-bottom-hidden border-left-hidden pt-0 vertical-align-top line-height-sm">
					<small>
						<em>
							CS FORM 212 (Revised 2017)
						</em>
					</small>
				</td>
			</tr>
		</tfoot>

	</tbody>
</table>
