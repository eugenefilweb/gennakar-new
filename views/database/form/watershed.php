<?php

use app\models\HazardMap;
use app\widgets\BootstrapSelect;
?>

<div class="row">
	<div class="col-md-12">
		<h3 class="card-label">Watershed</h3>
		 <hr/>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<?= BootstrapSelect::widget([
			'form' => $form,
			'model' => $model,
			'attribute' => 'watershed_id',
			'label' => 'Watershed',
			'data' => HazardMap::dropdown('id', 'name', ['type' => HazardMap::WATERSHED])
		]) ?>
	</div>
</div>
