<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\Directory;
use app\widgets\ActiveForm;
use app\widgets\DataList;
use app\widgets\ImageGallery;

/* @var $this yii\web\View */
/* @var $model app\models\Directory */
/* @var $form app\widgets\ActiveForm */

?>
<?php $form = ActiveForm::begin(['id' => 'directory-form']); ?>
    <div class="row">
        <div class="col-md-6">
            <?= DataList::widget([
                'model' => $model,
                'form' => $form,
                'attribute' => 'type',
                'data' => Directory::filter('type')
            ]) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= App::if($model->showFormField('position'), $form->field($model, 'position')->textInput(['maxlength' => true])) ?>
            <?= App::if($model->showFormField('address'), $form->field($model, 'address')->textarea(['rows' => 6])) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'contact_no')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-6">
            <?= Html::image($model->photo, ['w' => 200], [
                'class' => 'img-thumbnail directory-photo',
                'loading' => 'lazy',
            ] ) ?>
            <div class="my-2"></div>
            <?= ImageGallery::widget([
                'buttonTitle' => 'Choose Photo',
                'tag' => 'Directory',
                'model' => $model,
                'attribute' => 'photo',
                'ajaxSuccess' => "
                    if(s.status == 'success') {
                        $('.directory-photo').attr('src', s.src);
                    }
                ",
            ]) ?> 
        </div>
    </div>
    <div class="form-group">
		<?= ActiveForm::buttons() ?>
    </div>
<?php ActiveForm::end(); ?>