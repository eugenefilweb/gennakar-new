<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\PdsWorkExperience;
use app\widgets\Detail;

$workExperience = PdsWorkExperience::findOne(App::get('model_id'));
?>

<?php if ($workExperience): ?>
	<div class="d-flex justify-content-between align-items-baseline">
    <div>
        <h4 class="font-weight-bold text-dark"> Education Details</h4>
    </div>
    <div>
        <?= Html::a('Back', App::referrer(), [
            'class' => 'btn btn-outline-secondary font-weight-bolder',
        ]) ?>
    </div>
</div>

	<?= Detail::widget(['model' => $workExperience]) ?>

<?php endif ?>
