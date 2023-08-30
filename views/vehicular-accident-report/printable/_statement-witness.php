<div class="p-h1p2rem"></div>
<table width="100%">
	<tbody>
		<tr>
			<td colspan="4" class="text-center td-header p-btcb">STATEMENT</td>
		</tr>
		<tr>
			<td colspan="4" class="text-center td-header p-bbcb">Witness/Bystander #<?= $counter ?></td>
		</tr>
		<tr>
			<td colspan="4" class="p-vat h100vh"><?= $statement->statement ?></td>
		</tr>
		<tr>
			<td class="text-center font-weight-bold" width="25%">Date</td>
			<td class="text-center font-weight-bold" width="25%">Name</td>
			<td class="text-center font-weight-bold" width="25%">Address and Contact Info  </td>
			<td class="text-center font-weight-bold" width="25%">Signature</td>
		</tr>
		<tr>
			<td class="text-center"> <?= date('m/d/Y', strtotime($statement->date)) ?> </td>
			<td class="text-center"> <?= $statement->name ?>  </td>
			<td class="text-center"> <?= $statement->address ?> | <?= $statement->contact_info ?> </td>
			<td class="text-center">
				<img src="<?= $statement->signature ?>" class="img-fluid" width="100">
			</td>
		</tr>
	</tbody>
</table>
<?= $counter < $totalWitnessStatements ? '<div class="page-break"> </div>': '' ?>