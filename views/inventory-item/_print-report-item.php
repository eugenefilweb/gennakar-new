<?php

use app\helpers\App;

$this->registerCss(<<< CSS
	.table-container {font-size: 12pt;width: 100%;}
	.category { color: #F64E60 !important; }
	th { background: #9cc2e5 !important; padding: 1rem }
	td { padding:0.5rem; }
	@media print{
		.category { color: #F64E60 !important; }
		#stock, #desc, #qty, #unit, #remark { background-color: #9cc2e5 !important; }
	}
CSS);
?>
<table class="mt-10 table-container" border="1">
	<thead>
		<tr>
			<th id="stock" width="10%" class="line-height-sm">Stock No.</th>
			<th id="desc">item description</th>
			<th id="qty" width="10%">qty</th>
			<th id="unit" width="10%">unit</th>
			<th id="remark" width="15%">remark</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td></td>
			<td class="font-weight-bolder category">
				<?= strtoupper($category) ?>
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<?= App::foreach($inventory, fn ($item, $key, $counter) => <<< HTML
			<tr>
				<td>{$counter}</td>
				<td class="text-left">{$item->name}</td>
				<td>{$item->formattedQuantity}</td>
				<td>{$item->formattedUnit}</td>
				<td>{$item->remark}</td>
			</tr>
		HTML) ?>
	</tbody>
</table>