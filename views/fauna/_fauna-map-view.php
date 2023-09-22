<?php

use app\helpers\Html;
?>
<table class="" border="1" style="white-space: nowrap;">
	<tbody>
		<tr>
			<th class="p-1">photo</th>
			<td class="text-center p-1">
				<?= Html::image($model->photos['fullheight'][0] ?? [], ['w' => 100], [
					'class' => 'symbol',
					'style' => 'max-height:100px;'
				]) ?>
			</td>
		</tr>
		<tr>
			<th class="p-1"><?= $model->getAttributeLabel('common_name') ?></th>
			<td class="p-1"><?= $model->common_name ?></td>
		</tr>
		<tr>
			<th class="p-1"><?= $model->getAttributeLabel('kingdom') ?></th>
			<td class="p-1"><?= $model->kingdom ?></td>
		</tr>
		<tr>
			<th class="p-1"><?= $model->getAttributeLabel('family') ?></th>
			<td class="p-1"><?= $model->family ?></td>
		</tr>
		<tr>
			<th class="p-1"><?= $model->getAttributeLabel('genus') ?></th>
			<td class="p-1"><?= $model->genus ?></td>
		</tr>
		<tr>
			<th class="p-1"><?= $model->getAttributeLabel('species') ?></th>
			<td class="p-1"><?= $model->species ?></td>
		</tr>
		<tr>
			<th class="p-1"><?= $model->getAttributeLabel('sub_species') ?></th>
			<td class="p-1"><?= $model->sub_species ?></td>
		</tr>
		
		<tr>
			<th class="p-1"><?= $model->getAttributeLabel('varieta_and_infra_var_name') ?></th>
			<td class="p-1"><?= $model->varieta_and_infra_var_name ?></td>
		</tr>
		<!-- <tr>
			<th class="p-1"><?php //echo $model->getAttributeLabel('taxonomic_group') ?></th>
			<td class="p-1"><?php //echo $model->taxonomic_group ?></td>
		</tr> -->
		<tr>
			<th class="p-1"><?= $model->getAttributeLabel('growth_habit') ?></th>
			<td class="p-1"><?= $model->growth_habit ?></td>
		</tr>
		<tr>
			<th class="p-1"><?= $model->getAttributeLabel('category_id') ?></th>
			<td class="p-1"><?= $model->category_id ?></td>
		</tr>
		<tr>
			<th class="p-1"><?= $model->getAttributeLabel('conservation_status') ?></th>
			<td class="p-1"><?= $model->conservation_status ?></td>
		</tr>
		<tr>
			<th class="p-1"><?= $model->getAttributeLabel('diameter') ?></th>
			<td class="p-1"><?= $model->diameter ?></td>
		</tr>
		<tr>
			<th class="p-1"><?= $model->getAttributeLabel('date_encoded') ?></th>
			<td class="p-1"><?= $model->date_encoded ?></td>
		</tr>
	</tbody>
</table>