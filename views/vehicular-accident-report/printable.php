<?php

use app\helpers\App;
use app\models\search\VehicularAccidentReportSearch;
use app\widgets\Anchors;

$this->title = 'Post Accident Report: ' . $model->mainAttribute;
$this->params['sleep'] = 100; 
$this->params['withHeader'] = false;
$this->addCssFile('css/vehicular-accident-report');
?>

<div id="printable">
    <table width="100%" class="border-0">
        <thead>
            <tr class="border-0">
                <td class="border-0">
                    <?= $this->render('printable/header', ['model' => $model])?>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr class="border-0">
                <td class="border-0">
                    <?= $this->render('printable/vehicles', ['model' => $model]) ?>
                    <?= $this->render('printable/main-cause', ['model' => $model]) ?>
                    <?= $this->render('printable/passengers', ['model' => $model]) ?>
                    <?= $this->render('printable/statements', ['model' => $model]) ?>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr class="border-0">
                <td class="border-0">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td class="p-bh">
                                    <span>
                                        <?= $model->code ?>
                                    </span>
                                </td>
                                <td class="p-bh p-text-right">
                                    <span>Date Generated: <?= $model->generatedDate ?></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tfoot>
    </table>
</div>