<?php

use app\widgets\OpenLayer;
?>

<?= OpenLayer::widget([
    'latitude' => $model->latitude,
    'longitude' => $model->longitude,
]) ?>
<table class="text-dark-50 line-height-lg mt-5" border="1">
    <tbody>
        <tr>
            <th class="th-header"><?= $model->getAttributeLabel('latitude') ?></th>
            <td><?= $model->latitude ?> </td>
        </tr>
        <tr>
            <th class="th-header"><?= $model->getAttributeLabel('longitude') ?></th>
            <td><?= $model->longitude ?> </td>
        </tr>
    </tbody>
</table>