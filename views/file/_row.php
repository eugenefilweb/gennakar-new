<?php

use app\helpers\Html;

$withAction = $withAction ?? true;
$actions = $actions ?? [
    'view',
    'edit',
    'delete'
];
?>
<tr>
    <td>
        <?= $this->render('_row-filename', [
            'model' => $model
        ]) ?>
    </td>
    <?= Html::if(
        $withAction, 
        Html::tag('td', $this->render('_row-actions', [
            'model' => $model,
            'actions' => $actions
        ]), ['class' => 'text-center'])
    ) ?>
</tr>