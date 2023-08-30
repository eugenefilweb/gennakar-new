<?php

use app\models\InventoryItem;
use app\widgets\ActiveForm;
use app\widgets\DataList;

/* @var $this yii\web\View */
/* @var $model app\models\InventoryItem */
/* @var $form app\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'inventory-item-form']); ?>
    <div class="row">
        <div class="col-md-5">
            <?= $form->dataList($model, 'category', InventoryItem::filter('category')) ?>
			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'quantity')->textInput() ?>
			<?= $form->datePicker($model, 'date') ?>
            <?= $form->dataList($model, 'unit', InventoryItem::filter('unit')) ?>
			<?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <div class="form-group">
		<?= ActiveForm::buttons() ?>
    </div>
<?php ActiveForm::end(); ?>