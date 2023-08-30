<?php

use app\helpers\App;
use app\helpers\Html;
?>
<div class="p-h1p2rem"></div>
<table width="100%">
    <tbody>
        <tr>
            <td colspan="2" class="py-0 font-weight-bold">Photos of the Accidents (Vehicles)</td>
        </tr>
        <tr>
            <td width="50%" class="text-center td-header p-bbcb p-brw">PHOTO 1</td>
            <td width="50%" class="text-center td-header p-bbcb">PHOTO 2</td>
        </tr>
        <tr>
            <td class="text-center">
            	<?= App::if($model->photos[0] ?? '', fn ($token) => Html::image($token, ['w' => 400], [
                    'class' => 'img-fluid symbol',
                    'style' => 'max-height: 240px'
                ])) ?>
            </td>
            <td class="text-center">
            	<?= App::if($model->photos[1] ?? '', fn ($token) => Html::image($token, ['w' => 400], [
                    'class' => 'img-fluid symbol',
                    'style' => 'max-height: 240px'
                ])) ?>
            </td>
        </tr>
        <tr>
            <td class="text-center td-header p-bbcb p-brw">PHOTO 3</td>
            <td class="text-center td-header p-bbcb">PHOTO 4</td>
        </tr>
        <tr>
            <td class="text-center">
            	<?= App::if($model->photos[2] ?? '', fn ($token) => Html::image($token, ['w' => 400], [
                    'class' => 'img-fluid symbol',
                    'style' => 'max-height: 240px'
                ])) ?>
            </td>
            <td class="text-center">
                <?= App::if($model->photos[3] ?? '', fn ($token) => Html::image($token, ['w' => 400], [
                    'class' => 'img-fluid symbol',
                    'style' => 'max-height: 240px'
                ])) ?>
            </td>
        </tr>
    </tbody>
</table>
<div class="page-break"> </div>
