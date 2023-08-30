<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\PdsTrainingProgram;
use app\widgets\Detail;

$trainingProgram = PdsTrainingProgram::findOne(App::get('model_id'));
?>

<?php if ($trainingProgram): ?>
	<div class="d-flex justify-content-between align-items-baseline">
    <div>
        <h4 class="font-weight-bold text-dark"> Training Program Details</h4>
    </div>
    <div>
        <?= Html::a('Back', App::referrer(), [
            'class' => 'btn btn-outline-secondary font-weight-bolder',
        ]) ?>
    </div>
</div>

	<?= Detail::widget(['model' => $trainingProgram]) ?>

<?php endif ?>
