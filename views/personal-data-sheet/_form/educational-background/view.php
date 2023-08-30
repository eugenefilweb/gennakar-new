<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\PdsEducation;
use app\widgets\Detail;

$education = PdsEducation::findOne(App::get('model_id'));
?>

<?php if ($education): ?>
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

	<?= Detail::widget(['model' => $education]) ?>

<?php endif ?>
