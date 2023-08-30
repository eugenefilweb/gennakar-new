<?php

use app\helpers\App;
use app\helpers\Html;
?>

<div class="d-flex justify-content-between align-items-baseline">
    <div>
        <h4 class="font-weight-bold text-dark"> Add Voluntary Work </h4>
    </div>
    <div>
        <?= Html::a('Back', App::referrer(), [
            'class' => 'btn btn-outline-secondary font-weight-bolder',
        ]) ?>
    </div>
</div>
<?= $this->render('_form', [
	'organization' => $model->organizationModel,
	'action' => $action,
	'model' => $model,
	'organizationAction' => 'create',
]) ?>
