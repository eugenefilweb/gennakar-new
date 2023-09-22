<?php

use app\models\Fauna;
use app\widgets\Filter;

$totalFilterTag = $searchModel->totalFilterTag($attribute);
$options = $data ?? Fauna::filter($attribute);
?>

<?php if ($options): ?>
    <div class="card" data-title="<?= $searchModel->getAttributeLabel($attribute) ?>">
        <div class="card-header">
            <div class="card-title collapsed" data-toggle="collapse" data-target="#<?= $attribute ?>-container" aria-expanded="false">
                <!-- <i class="fas fa-house-user"></i> -->
                <span><?= $searchModel->getAttributeLabel($attribute) ?> <?= $totalFilterTag ?></span>
            </div>
        </div>
        <div id="<?= $attribute ?>-container" class="collapse <?= $totalFilterTag ? 'show': '' ?>" >
            <div class="card-body">
                <?= Filter::widget([
                    'form' => $form,
                    'model' => $searchModel,
                    'attribute' => $attribute,
                    'forceShowOptions' => true,
                    'title' => false,
                    'data' => $options
                ]) ?>
            </div>
        </div>
    </div>
<?php endif ?>
