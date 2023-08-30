<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\PdsEducation;
?>

<div class="d-flex justify-content-between align-items-baseline">
    <div>
        <h4 class="font-weight-bold text-dark"> Update Education </h4>
    </div>
    <div>
        <?= Html::a('Back', App::referrer(), [
            'class' => 'btn btn-outline-secondary font-weight-bolder',
        ]) ?>
    </div>
</div>
<?= $this->render('_form', [
	'education' => PdsEducation::findOne(App::get('model_id')),
	'action' => $action,
	'model' => $model,
	'educationAction' => 'update'
]) ?>
