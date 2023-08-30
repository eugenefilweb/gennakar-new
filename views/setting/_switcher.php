<tr>
	<td>
		<label class="form-label"><?= $model->getAttributeLabel($attribute) ?>
	</td>
	<td>
		<span class="switch switch-outline switch-icon switch-success ml-5">
			<label>
				<input type="checkbox" value="1" name="MySettingForm[<?= $attribute ?>]" <?= $model->{$attribute} ? 'checked': '' ?>>
				<span></span>
			</label>
		</span>
	</td>
</tr>