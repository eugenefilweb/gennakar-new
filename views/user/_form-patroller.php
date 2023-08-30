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
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Main Information'
            ]) ?>
                <?= $form->field($model, 'nice_name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

                <div class="row">
                    <div class="col">
                        <?= BootstrapSelect::widget([
                            'attribute' => 'status',
                            'searchable' => false,
                            'model' => $model,
                            'form' => $form,
                            'data' => App::keyMapParams('user_status'),
                        ]) ?>
                    </div>
                    <div class="col">
                        <?= ActiveForm::recordStatus([
                            'model' => $model,
                            'form' => $form,
                        ]) ?>
                    </div>
                    <div class="col">
                        <?= BootstrapSelect::widget([
                            'attribute' => 'is_blocked',
                            'searchable' => false,
                            'model' => $model,
                            'form' => $form,
                            'data' => App::keyMapParams('user_block_status'),
                        ]) ?>
                    </div>
                </div>

                <?= Html::image($model->photo, ['w'=>200], [
                    'class' => 'img-thumbnail user-photo',
                    'loading' => 'lazy',
                ] ) ?>
                <div class="my-3"></div>
                <?=  ImageGallery::widget([
                    'tag' => 'User',
                    'model' => $model,
                    'attribute' => 'photo',
                    'ajaxSuccess' => "
                        if(s.status == 'success') {
                            $('.user-photo').attr('src', s.src + '');
                        }
                    ",
                ]) ?> 
            <?php $this->endContent() ?>
        </div>
        <div class="col-md-6">
            <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
                'title' => 'Account Information',
                'stretch' => true
            ]) ?>
                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                
                <?= Html::if(true, implode(' ', [
                    (! $model->isNewRecord ? Html::tag('div', '<hr>Leave blank if you don\'t want to change your password', ['class' => 'my-3']): ''),
                    $form->field($model, 'password')->passwordInput(['maxlength' => true]),
                    $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true])
                ])) ?>
            <?php $this->endContent() ?>
        </div>
    </div>
    <div class="form-group"><br>
		<?= ActiveForm::buttons() ?>
    </div>
<?php ActiveForm::end(); ?>