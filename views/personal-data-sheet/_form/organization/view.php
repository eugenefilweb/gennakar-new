<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\PdsOrganization;
use app\widgets\Detail;

$organization = PdsOrganization::findOne(App::get('model_id'));
?>

<?php if ($organization): ?>
	<div class="d-flex justify-content-between align-items-baseline">
    <div>
        <h4 class="font-weight-bold text-dark"> Voluntary Work Details</h4>
    </div>
    <div>
        <?= Html::a('Back', App::referrer(), [
            'class' => 'btn btn-outline-secondary font-weight-bolder',
        ]) ?>
    </div>
</div>

	<?= Detail::widget(['model' => $organization]) ?>

<?php endif ?>
