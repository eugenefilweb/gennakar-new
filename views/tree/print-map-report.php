<?php

use app\helpers\App;
use app\helpers\Html;
use app\widgets\OpenLayer;
?>

<div class="text-center mt-5">
	<h1>Tree-Map Report</h1>
	<p><?= App::formatter()->asDateToTimezone('', 'F d, Y h:i A') ?></p>
</div>
<div>
	<?= OpenLayer::widget([
	    'coordinates' => $coordinates,
	    'zoom' => $searchModel->map_zoom_level,
	    'withSearch' => false
	]) ?>
</div>

<table class="table table-bordered">
	<thead>
		<tr>
			<th><?= $searchModel->getAttributeLabel('treeNumber') ?></th>
			<th><?= $searchModel->getAttributeLabel('common_name') ?></th>
			<th><?= $searchModel->getAttributeLabel('kingdom') ?></th>
			<th><?= $searchModel->getAttributeLabel('family') ?></th>
			<th><?= $searchModel->getAttributeLabel('genus') ?></th>
			<th><?= $searchModel->getAttributeLabel('species') ?></th>
			<th><?= $searchModel->getAttributeLabel('sub_species') ?></th>
			<th><?= $searchModel->getAttributeLabel('varieta_and_infra_var_name') ?></th>
			<th><?= $searchModel->getAttributeLabel('taxonomic_group') ?></th>
			<th><?= $searchModel->getAttributeLabel('date_encoded') ?></th>
			<th><?= $searchModel->getAttributeLabel('createdByName') ?></th>
		</tr>
	</thead>
	<tbody>	
		<?= App::foreach($models, fn ($model) => <<< HTML
			<tr>
				<td>{$model->treeNumber}</td>
				<td>{$model->common_name}</td>
				<td>{$model->kingdom}</td>
				<td>{$model->family}</td>
				<td>{$model->genus}</td>
				<td>{$model->species}</td>
				<td>{$model->sub_species}</td>
				<td>{$model->varieta_and_infra_var_name}</td>
				<td>{$model->taxonomic_group}</td>
				<td>{$model->date_encoded}</td>
				<td>{$model->createdByName}</td>
			</tr>
		HTML) ?>
	</tbody>
</table>
