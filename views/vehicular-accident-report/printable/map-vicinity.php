<?php

use app\helpers\App;
use app\helpers\Html;
use app\widgets\OpenLayer;
?>
<div class="p-h1p2rem"></div>
<table width="100%">
    <tbody>
        <tr>
            <td class="py-0 font-weight-bold" width="80%">Vicinity MAP</td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td class="td-header p-bbcb p-brw p-brcb text-center">MAP COORDINATES</td>
            <td colspan="2" class="td-header p-bbcb"></td>
        </tr>
        <tr>
            <td rowspan="13" class="text-center">
                <div class="m-auto">
                    <?= OpenLayer::widget([
                        'latitude' => $model->latitude,
                        'longitude' => $model->longitude,
                        'height' => '500px',
                        'withSearch' => false
                    ]) ?>
                </div>
            </td>
            <td class="font-weight-bolder text-center"> Barangay </td>
        </tr>
        <tr>
            <td class="text-center"><?= $model->barangay ?></td>
        </tr>
        <tr>
            <td class="font-weight-bolder text-center"> Landmarks </td>
        </tr>
        <tr>
            <td class="text-center"><?= $model->landmarks ?></td>
        </tr>
        <tr>
            <td class="font-weight-bolder text-center"> Road Type </td>
        </tr>
        <tr>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'road_type', '', [
                            'checked' => trim($model->road_type) == $model->getParamRoadType(0)
                        ]) ?>
                        <span></span><?= $model->getParamRoadType(0) ?>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'road_type', '', [
                            'checked' => trim($model->road_type) == $model->getParamRoadType(1)
                        ]) ?>
                        <span></span><?= $model->getParamRoadType(1) ?>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'road_type', '', [
                            'checked' => trim($model->road_type) == $model->getParamRoadType(2)
                        ]) ?>
                        <span></span><?= $model->getParamRoadType(2) ?>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'road_type', '', [
                            'checked' => trim($model->road_type) == $model->getParamRoadType(3)
                        ]) ?>
                        <span></span><?= $model->getParamRoadType(3) ?>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'road_type', '', [
                            'checked' => trim($model->road_type) == $model->getParamRoadType(4)
                        ]) ?>
                        <span></span><?= $model->getParamRoadType(4) ?>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'road_type', '', [
                            'checked' => trim($model->road_type) == $model->getParamRoadType(5)
                        ]) ?>
                        <span></span><?= $model->getParamRoadType(5) ?>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'road_type', '', [
                            'checked' => trim($model->road_type) == $model->getParamRoadType(6)
                        ]) ?>
                        <span></span><?= $model->getParamRoadType(6) ?>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'road_type', '', [
                            'checked' => $model->otherRoadType ? true: false
                        ]) ?>
                        <span></span>Others: <?= $model->otherRoadType ?>
                    </label>
                </div>
            </td>
        </tr>
    </tbody>
</table>
