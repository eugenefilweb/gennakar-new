<?php

use app\helpers\App;
use app\helpers\Html;
?>

<table class="text-dark-50 line-height-lg" border="1">
    <tbody>
        <tr>
            <th class="th-header"><?= $model->getAttributeLabel('control_no') ?></th>
            <td><?= $model->control_no ?> </td>
        </tr>
        <tr>
            <th class="th-header"><?= $model->getAttributeLabel('code') ?></th>
            <td><?= $model->code ?> </td>
        </tr>
        <tr>
            <th class="th-header"><?= $model->getAttributeLabel('date') ?></th>
            <td><?= $model->date ?> </td>
        </tr>
        <tr>
            <th class="th-header"><?= $model->getAttributeLabel('main_cause') ?></th>
            <td><?= $model->main_cause ?> </td>
        </tr>
        <tr>
            <th class="th-header"><?= $model->getAttributeLabel('preferred_by') ?></th>
            <td><?= $model->preferred_by ?> </td>
        </tr>
        <tr>
            <th class="th-header"><?= $model->getAttributeLabel('noted_by') ?></th>
            <td><?= $model->noted_by ?> </td>
        </tr>
        <tr>
            <th class="th-header"><?= $model->getAttributeLabel('collision_type') ?></th>
            <td><?= $model->collision_type ?> </td>
        </tr>
        <tr>
            <th class="th-header"><?= $model->getAttributeLabel('weather_condition') ?></th>
            <td><?= $model->weather_condition ?> </td>
        </tr>
        <tr>
            <th class="th-header"><?= $model->getAttributeLabel('road_condition') ?></th>
            <td><?= $model->road_condition ?> </td>
        </tr>
        <tr>
            <th class="th-header"><?= $model->getAttributeLabel('barangay') ?></th>
            <td><?= $model->barangay ?> </td>
        </tr>
        <tr>
            <th class="th-header"><?= $model->getAttributeLabel('landmarks') ?></th>
            <td><?= $model->landmarks ?> </td>
        </tr>
        <tr>
            <th class="th-header"><?= $model->getAttributeLabel('road_type') ?></th>
            <td><?= $model->road_type ?> </td>
        </tr>
        <tr>
            <th class="th-header"><?= $model->getAttributeLabel('remarks') ?></th>
            <td><?= $model->remarks ?> </td>
        </tr>
        <tr>
            <th class="th-header"><?= $model->getAttributeLabel('photos') ?></th>
            <td>
                <?= App::foreach($model->photos, fn ($token) => Html::a(Html::image($token, ['w' => 100], [
                    'class' => 'img-fluid symbol'
                ]), ['file/viewer', 'token' => $token], ['target' => '_blank'])) ?>
            </td>
        </tr>
        <tr>
            <th class="th-header"><?= $model->getAttributeLabel('other_damages') ?></th>
            <td>
                <?= App::foreach($model->other_damages, fn ($token) => Html::a(Html::image($token, ['w' => 100], [
                    'class' => 'img-fluid symbol'
                ]), ['file/viewer', 'token' => $token], ['target' => '_blank'])) ?>
            </td>
        </tr>
         <tr>
            <th class="th-header"><?= $model->getAttributeLabel('sketch') ?></th>
            <td>
                <?= Html::a(Html::image($model->sketch, ['w' => 100], [
                    'class' => 'img-fluid symbol',
                ]), ['file/viewer', 'token' => $model->sketch], ['target' => '_blank']) ?>
            </td>
        </tr>
    </tbody>
</table>