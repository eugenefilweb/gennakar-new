<div class="p-h1p2rem"></div>
<table width="100%">
	<tbody>
		<tr>
			<td colspan="4" class="text-center td-header p-btcb">STATEMENT</td>
		</tr>
		<tr>
			<td colspan="4" class="text-center td-header p-bbcb">DRIVER #<?= $counter ?></td>
		</tr>
		<tr>
			<td colspan="4" class="p-vat h100vh"><?= $vehicle->statement ?></td>
		</tr>
		<tr>
			<td class="text-center font-weight-bold" width="25%">Date</td>
			<td class="text-center font-weight-bold" width="25%">Vehicle Plate Number </td>
			<td class="text-center font-weight-bold" width="25%">Name</td>
			<td class="text-center font-weight-bold" width="25%">Signature</td>
		</tr>
		<tr>
			<td class="text-center"> <?= date('m/d/Y', strtotime($vehicle->createdAt)) ?> </td>
			<td class="text-center"> <?= $vehicle->type ?> | <?= $vehicle->plate_no ?> </td>
			<td class="text-center"> <?= $vehicle->driverFullname ?> </td>
			<td class="text-center">
				<img src="<?= $vehicle->signature ?>" class="img-fluid" width="100">
			</td>
		</tr>
	</tbody>
</table>
<div class="page-break"> </div>
