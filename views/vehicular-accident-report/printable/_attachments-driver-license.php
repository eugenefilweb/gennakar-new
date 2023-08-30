<?php

use app\helpers\Html;
?>

<div class="p-h1p2rem"></div>
<table width="100%">
    <tbody>
        <tr>
            <td colspan="2" class="py-0 font-weight-bold">Attachments: Driver #<?= $counter ?></td>
        </tr>
        <tr>
            <td width="50%" class="text-center td-header p-bbcb p-brw">Driver’s License (Front)</td>
            <td width="50%" class="text-center td-header p-bbcb">Driver’s License (Back)</td>
        </tr>
        <tr>
            <td class="text-center">
                <?= Html::image($vehicle->driver_license_front, ['w' => 400], [
                    'class' => 'img-fluid symbol',
                    'style' => 'max-height: 240px;'
                ]) ?>
            </td>
            <td class="text-center">
                <?= Html::image($vehicle->driver_license_back, ['w' => 400], [
                    'class' => 'img-fluid symbol',
                    'style' => 'max-height: 240px;'
                ]) ?>
            </td>
        </tr>
        <tr>
            <td class="text-center td-header p-bbcb p-brw">Official Receipt</td>
            <td class="text-center td-header p-bbcb">Certificate of Registration</td>
        </tr>
        <tr>
            <td class="text-center">
                <?= Html::image($vehicle->or_photo, ['w' => 400], [
                    'class' => 'img-fluid symbol',
                    'style' => 'max-height: 240px;'
                ]) ?>
            </td>
            <td class="text-center">
                <?= Html::image($vehicle->cr_photo, ['w' => 400], [
                    'class' => 'img-fluid symbol',
                    'style' => 'max-height: 240px;'
                ]) ?>
            </td>
        </tr>
    </tbody>
</table>
<div class="page-break"> </div>
