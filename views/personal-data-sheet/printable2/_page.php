<?php

use app\helpers\Html;
use app\models\PersonalDataSheet;
?>

<table border="1">
	<tbody>
		<tr>
			<td class="border-top-hidden border-right-hidden border-left-hidden" width="9%"></td>
			<td class="border-top-hidden border-right-hidden" width="9%"></td>
			<td class="border-top-hidden border-right-hidden" width="10%"></td>
			<td class="border-top-hidden border-right-hidden" width="10%"></td>
			<td class="border-top-hidden border-right-hidden" width="16%"></td>
			<td class="border-top-hidden border-right-hidden"></td>
			<td class="border-top-hidden border-right-hidden"></td>
			<td class="border-top-hidden border-right-hidden" width="9%"></td>
			<td class="border-top-hidden border-right-hidden" width="9%"></td>
			<td class="border-top-hidden border-right-hidden" width="9%"></td>
			<td class="border-top-hidden border-right-hidden" width="9%"></td>
		</tr>

		<?php echo $this->render('_page/header', ['model' => $model]) ?>
		<?php echo $this->render('_page/personal-information', ['model' => $model]) ?>
		<?php echo $this->render('_page/family-background', ['model' => $model]) ?>
		<?php echo $this->render('_page/educational-background', ['model' => $model]) ?>
		<?php echo $this->render('_page/civil-service', ['model' => $model]) ?>
		<?php echo $this->render('_page/work-experience', ['model' => $model]) ?>
		<?php echo $this->render('_page/voluntary-work', ['model' => $model]) ?>
		<?php echo $this->render('_page/training-program', ['model' => $model]) ?>
		<?php echo $this->render('_page/other-information', ['model' => $model]) ?>
	</tbody>

	
	<tfoot class="border-bottom-hidden">
		<tr>
			<td colspan="11" class="text-right border-right-hidden border-bottom-hidden border-left-hidden pt-0 vertical-align-top line-height-sm">
				<small>
					<em>
						CS FORM 212 (Revised 2017)
					</em>
				</small>
			</td>
		</tr>
	</tfoot>
</table>