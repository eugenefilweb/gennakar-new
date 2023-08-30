<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\PdsWorkExperience;
?>

<div class="d-flex justify-content-between align-items-baseline">
    <div>
        <h4 class="font-weight-bold text-dark"> Update Work Experience </h4>
    </div>
    <div>
        <?= Html::a('Back', App::referrer(), [
            'class' => 'btn btn-outline-secondary font-weight-bolder',
        ]) ?>
    </div>
</div>
<?= $this->render('_form', [
	'workExperience' => PdsWorkExperience::findOne(App::get('model_id')),
	'action' => $action,
	'model' => $model,
	'workExperienceAction' => 'update'
]) ?>
