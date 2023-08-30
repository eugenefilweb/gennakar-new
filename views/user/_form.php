<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\User;
use app\models\search\RoleSearch;
use app\widgets\ActiveForm;
use app\widgets\BootstrapSelect;
use app\widgets\ChangePhoto;
use app\widgets\ImageGallery;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'user-form']); ?>
    <div class="row">
        <div class="col-md-6">
            <?= BootstrapSelect::widget([
                'attribute' => 'role_id',
                'model' => $model,
                'form' => $form,
                'data' => RoleSearch::dropdownAccess(),
            ]) ?>
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            
            <?= Html::if($model->isNewRecord, implode(' ', [
                $form->field($model, 'password')->passwordInput(['maxlength' => true]),
                $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true])
            ])) ?>

            <?= BootstrapSelect::widget([
                'attribute' => 'status',
                'searchable' => false,
                'model' => $model,
                'form' => $form,
                'data' => App::keyMapParams('user_status'),
            ]) ?>
            <?= ActiveForm::recordStatus([
                'model' => $model,
                'form' => $form,
            ]) ?>
            <?= BootstrapSelect::widget([
                'attribute' => 'is_blocked',
                'searchable' => false,
                'model' => $model,
                'form' => $form,
                'data' => App::keyMapParams('user_block_status'),
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'nice_name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'department')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>

            <?= Html::image($model->photo, ['w'=>200], [
                'class' => 'img-thumbnail user-photo',
                'loading' => 'lazy',
            ] ) ?>
            <div class="my-2"></div>
            <?= ImageGallery::widget([
                'tag' => 'User',
                'model' => $model,
                'attribute' => 'photo',
                'ajaxSuccess' => "
                    if(s.status == 'success') {
                        $('.user-photo').attr('src', s.src + '');
                    }
                ",
            ]) ?> 
        </div>
    </div>
    <div class="form-group text-center">
		<?= ActiveForm::buttons('lg') ?>
    </div>
<?php ActiveForm::end(); ?>