<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\PdsCivilService;
use app\widgets\Detail;

$civilService = PdsCivilService::findOne(App::get('model_id'));
?>

<?php if ($civilService): ?>
	<div class="d-flex justify-content-between align-items-baseline">
    <div>
        <h4 class="font-weight-bold text-dark"> Civil Service Details</h4>
    </div>
    <div>
        <?= Html::a('Back', App::referrer(), [
            'class' => 'btn btn-outline-secondary font-weight-bolder',
        ]) ?>
    </div>
</div>

	<?= Detail::widget(['model' => $civilService]) ?>

<?php endif ?>
