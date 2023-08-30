<?php

use app\helpers\App;
use app\helpers\Html;
?>
<div class="p-h1p2rem"></div>
<table width="100%">
    <tbody>
        <tr>
            <td class="py-0 font-weight-bold" width="60%">Sketch</td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td class="td-header p-bbcb p-brw p-brcb text-center">ACTUAL SKETCH</td>
            <td colspan="2" class="td-header p-bbcb"></td>
        </tr>
        <tr>
            <td rowspan="15" class="text-center">
                <?= App::if($model->sketch, fn ($sketch) => Html::image($sketch, ['w' => 1000], [
                    'class' => 'img-fluid symbol'
                ])) ?>
            </td>
            <td colspan="2" class="font-weight-bolder text-center"> Collision Type </td>
        </tr>
        <tr>
            <td width="20%">
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'collision_type', '', [
                            'checked' => trim($model->collision_type) == $model->getParamCollisionType(0)
                        ]) ?>
                        <span></span><?= $model->getParamCollisionType(0) ?>
                    </label>
                </div>
            </td>
            <td width="20%">
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'collision_type', '', [
                            'checked' => trim($model->collision_type) == $model->getParamCollisionType(1)
                        ]) ?>
                        <span></span><?= $model->getParamCollisionType(1) ?>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'collision_type', '', [
                            'checked' => trim($model->collision_type) == $model->getParamCollisionType(2)
                        ]) ?>
                        <span></span><?= $model->getParamCollisionType(2) ?>
                    </label>
                </div>
            </td>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'collision_type', '', [
                            'checked' => trim($model->collision_type) == $model->getParamCollisionType(3)
                        ]) ?>
                        <span></span><?= $model->getParamCollisionType(3) ?>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'collision_type', '', [
                            'checked' => trim($model->collision_type) == $model->getParamCollisionType(4)
                        ]) ?>
                        <span></span><?= $model->getParamCollisionType(4) ?>
                    </label>
                </div>
            </td>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'collision_type', '', [
                            'checked' => trim($model->collision_type) == $model->getParamCollisionType(5)
                        ]) ?>
                        <span></span><?= $model->getParamCollisionType(5) ?>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'collision_type', '', [
                            'checked' => trim($model->collision_type) == $model->getParamCollisionType(6)
                        ]) ?>
                        <span></span><?= $model->getParamCollisionType(6) ?>
                    </label>
                </div>
            </td>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'collision_type', '', [
                            'checked' => trim($model->collision_type) == $model->getParamCollisionType(7)
                        ]) ?>
                        <span></span><?= $model->getParamCollisionType(7) ?>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'collision_type', '', [
                            'checked' => $model->otherCollisionType ? true: false
                        ]) ?>
                        <span></span>Others: <?= $model->otherCollisionType ?>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="font-weight-bolder text-center">Weather Condition</td>
        </tr>
        <tr>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'weather_condition', '', [
                            'checked' => trim($model->weather_condition) == $model->getParamWeatherCondition(0)
                        ]) ?>
                        <span></span><?= $model->getParamWeatherCondition(0) ?>
                    </label>
                </div>
            </td>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'weather_condition', '', [
                            'checked' => trim($model->weather_condition) == $model->getParamWeatherCondition(1)
                        ]) ?>
                        <span></span><?= $model->getParamWeatherCondition(1) ?>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'weather_condition', '', [
                            'checked' => trim($model->weather_condition) == $model->getParamWeatherCondition(2)
                        ]) ?>
                        <span></span><?= $model->getParamWeatherCondition(2) ?>
                    </label>
                </div>
            </td>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'weather_condition', '', [
                            'checked' => trim($model->weather_condition) == $model->getParamWeatherCondition(3)
                        ]) ?>
                        <span></span><?= $model->getParamWeatherCondition(3) ?>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'weather_condition', '', [
                            'checked' => trim($model->weather_condition) == $model->getParamWeatherCondition(4)
                        ]) ?>
                        <span></span><?= $model->getParamWeatherCondition(4) ?>
                    </label>
                </div>
            </td>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'weather_condition', '', [
                            'checked' => trim($model->weather_condition) == $model->getParamWeatherCondition(5)
                        ]) ?>
                        <span></span><?= $model->getParamWeatherCondition(5) ?>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'weather_condition', '', [
                            'checked' => trim($model->weather_condition) == $model->getParamWeatherCondition(6)
                        ]) ?>
                        <span></span><?= $model->getParamWeatherCondition(6) ?>
                    </label>
                </div>
            </td>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'weather_condition', '', [
                            'checked' => $model->otherWeatherCondition ? true: false
                        ]) ?>
                        <span></span>Others: <?= $model->otherWeatherCondition ?>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="font-weight-bolder text-center"> Road Condition </td>
        </tr>
        <tr>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'road_condition', '', [
                            'checked' => trim($model->road_condition) == $model->getParamRoadCondition(0)
                        ]) ?>
                        <span></span><?= $model->getParamRoadCondition(0) ?>
                    </label>
                </div>
            </td>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'road_condition', '', [
                            'checked' => trim($model->road_condition) == $model->getParamRoadCondition(1)
                        ]) ?>
                        <span></span><?= $model->getParamRoadCondition(1) ?>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'road_condition', '', [
                            'checked' => trim($model->road_condition) == $model->getParamRoadCondition(2)
                        ]) ?>
                        <span></span><?= $model->getParamRoadCondition(2) ?>
                    </label>
                </div>
            </td>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'road_condition', '', [
                            'checked' => trim($model->road_condition) == $model->getParamRoadCondition(3)
                        ]) ?>
                        <span></span><?= $model->getParamRoadCondition(3) ?>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'road_condition', '', [
                            'checked' => trim($model->road_condition) == $model->getParamRoadCondition(4)
                        ]) ?>
                        <span></span><?= $model->getParamRoadCondition(4) ?>
                    </label>
                </div>
            </td>
            <td>
               <div class="radio-list">
                    <label class="radio">
                        <?= Html::input('radio', 'road_condition', '', [
                            'checked' => $model->otherRoadCondition ? true: false
                        ]) ?>
                        <span></span>Others: <?= $model->otherRoadCondition ?>
                    </label>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<div class="page-break"> </div>
