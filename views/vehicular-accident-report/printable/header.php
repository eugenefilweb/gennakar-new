<?php

use app\helpers\App;
use app\helpers\Url;
?>

<table width="100%">
    <tbody>
        <tr>
            <td rowspan="2" width="11%" class="p-text-center">
                <img src="<?= Url::image(App::setting('image')->primary_logo, ['w' => 100]) ?>">
            </td>
            <td class="p-text-center">
                <span class="p-fw-600 p-fs-2rem">
                    MDRRMO
                </span>
            </td>
            <td width="20%" class="p-text-center p-color-white p-bg-black p-bc-black p-fw600">
                <span>Control No</span>
            </td>
        </tr>
        <tr>
            <td class="p-text-center p-header p-color-black p-bg-red">
                <span class="p-fw-600 p-fs-2rem">VEHICULAR ACCIDENT REPORT</span>
            </td>
            <td class="p-text-center">
                <span class="p-fw-600">
                    <?= $model->control_no ?>
                </span>
            </td>
        </tr>
    </tbody>
</table>