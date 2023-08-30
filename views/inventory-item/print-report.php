<?php

use app\helpers\App;
$this->params['withHeader'] = false;
$this->params['sleep'] = 100;
?>
<div class="text-center">
	<h1>
		LDRRMO INVENTORY OF EQUIPMENT, SUPPLIES & STOCKPILED GOODS SUPPIES & STOCKPILED GOODS 
	</h1>
	<h3>General Nakar, Quezon as of <?= date('F d, Y', strtotime($start)) ?> to <?= date('F d, Y', strtotime($end)) ?></h3>
	<?= App::foreach($inventories, fn ($inventory, $category) => $this->render('_print-report-item', [
		'inventory' => $inventory,
		'category' => $category,
	])) ?>
</div>