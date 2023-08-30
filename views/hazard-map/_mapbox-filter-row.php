<?php

use app\helpers\App;
use app\helpers\Html;
use app\helpers\MapboxHelper;
?>

<tr data-layer="<?= $layer['id'] ?>" style="vertical-align: <?= $align ?? 'bottom' ?>;">
    <td>
        <label class="checkbox mb-0 font-weight-bold">
            <?= Html::input('checkbox', 'filter', $layer['id'], [
                'checked' => $layer['visible'],
                'data-zoom' => $layer['zoom'] ?? 10
            ]) ?>
            <span></span> &nbsp;
            <?= $label ?? $layer['label'] ?>
        </label>
    </td>
    <td class="text-right">
        <div>
            <small>Opacity</small> 
            <span class="font-weight-bold">(<?= $layer['opacity'] ?>)</span>
        </div>

        <?= Html::input('range', '', $layer['opacity'], [
            'min' => 0,
            'max' => 100,
            'style' => isset($layer['colors']) ? 'background: linear-gradient(to right, '.$layer['colors'][0].', '.$layer['colors'][1].')': ''
        ]) ?>
    </td>
</tr>

<?php if (isset($layer['data_labels'])): ?>
    <tr>
        <td colspan="2">
            <div class="ml-10">
                <?= App::foreach(MapboxHelper::getColorScheme($layer['data_labels'], $layer['color_key']), fn ($data, $name) => <<< HTML
                    <div class="d-flex mb-1">
                        <div data-toggle="tooltip" title="{$data['name']}" class="color-box" style="background-color: {$data['color']}"></div>
                        <div class="ml-1"><span>{$name}</span></div>
                    </div>
                HTML) ?>
                <div class="d-flex mb-1">
                    <div data-toggle="tooltip" title="Black" class="color-box" style="background-color: #000"></div>
                    <div class="ml-1"><span>Not Set</span></div>
                </div> 
            </div>
        </td>
    </tr>
<?php endif ?>