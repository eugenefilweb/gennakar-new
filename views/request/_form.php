<?php

use app\helpers\Html;
use app\models\HazardMap;
use app\widgets\ActiveForm;
use app\widgets\DataList;
use app\widgets\InputList;

/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $form app\widgets\ActiveForm */
$this->params['wrapCard'] = false;
?>
<?php $form = ActiveForm::begin(['id' => 'request-form']); ?>
    <div class="row">
        <div class="col-md-6">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Patient Details',
                'stretch' => true
            ]) ?>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                <?= DataList::widget([
                    'form' => $form,
                    'model' => $model,
                    'attribute' => 'barangay',
                    'data' => HazardMap::dropdown('name', 'name', ['type' => HazardMap::WATERSHED])
                ]) ?>
                <?= $form->field($model, 'sex')->radioList( [0=>'Male', 1 => 'Female']) ?>

                <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'pickup_address')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'chief_complaint')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'other_complaints')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'destination')->textInput(['maxlength' => true]) ?>
            <?php $this->endContent() ?>
        </div>
        <div class="col-md-6">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Other Details',
                'stretch' => true
            ]) ?>
                <?= $form->field($model, 'driver')->textInput(['maxlength' => true]) ?>
                <div class="form-group">
                    <label class="control-label"> Responders </label>
                    <?= InputList::widget([
                        'label' => 'Responder',
                        'name' => 'Request[responders][]',
                        'data' => $model->responders
                    ]) ?>
                </div>

                <div class="form-group">
                    <label class="control-label"> Patient Companions </label>
                    <?= InputList::widget([
                        'label' => 'Responder',
                        'name' => 'Request[patient_companions][]',
                        'data' => $model->patient_companions
                    ]) ?>
                </div>

                <?= $form->field($model, 'description')->textarea(['rows' => 8]) ?>

            <?php $this->endContent() ?>
        </div>
    </div>

    <div class="form-group">
        <?= ActiveForm::buttons('lg') ?>
    </div>
<?php ActiveForm::end(); ?>
